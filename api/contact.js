const CONTACT_EMAIL = process.env.CONTACT_EMAIL || 'contact@trucking24fit.org';

function json(res, status, body) {
  res.statusCode = status;
  res.setHeader('Content-Type', 'application/json; charset=utf-8');
  res.setHeader('X-Content-Type-Options', 'nosniff');
  res.end(JSON.stringify(body));
}

function readBody(req) {
  return new Promise((resolve, reject) => {
    const chunks = [];
    req.on('data', (c) => chunks.push(c));
    req.on('end', () => {
      const raw = Buffer.concat(chunks).toString('utf8');
      if (!raw) return resolve({});
      try {
        resolve(JSON.parse(raw));
      } catch {
        reject(new Error('Invalid JSON body'));
      }
    });
    req.on('error', reject);
  });
}

function clean(value, max = 500) {
  return String(value ?? '')
    .replace(/<[^>]*>/g, '')
    .trim()
    .slice(0, max);
}

async function deliver(subject, text, replyTo) {
  if (process.env.RESEND_API_KEY) {
    const from = process.env.FROM_EMAIL || 'Trucking24Fit Website <onboarding@resend.dev>';
    const r = await fetch('https://api.resend.com/emails', {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${process.env.RESEND_API_KEY}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        from,
        to: [CONTACT_EMAIL],
        subject,
        text,
        reply_to: replyTo || undefined,
      }),
    });
    if (!r.ok) {
      const err = await r.text();
      throw new Error(`Email provider error: ${err}`);
    }
    return;
  }

  const r = await fetch(`https://formsubmit.co/ajax/${encodeURIComponent(CONTACT_EMAIL)}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
    body: JSON.stringify({
      _subject: subject,
      message: text,
      email: replyTo || CONTACT_EMAIL,
      _template: 'table',
    }),
  });
  if (!r.ok) {
    const err = await r.text();
    throw new Error(`Form delivery error: ${err}`);
  }
}

module.exports = async function handler(req, res) {
  if (req.method !== 'POST') {
    return json(res, 405, { success: false, message: 'Method not allowed.' });
  }

  let data;
  try {
    data = await readBody(req);
  } catch {
    return json(res, 400, { success: false, message: 'Invalid request body.' });
  }

  if (clean(data.website_url, 200)) {
    return json(res, 200, { success: true, message: 'Thank you. Your message has been sent. We will get back to you soon.' });
  }

  const fields = {
    full_name: clean(data.full_name, 120),
    company_name: clean(data.company_name, 160),
    email: clean(data.email, 160),
    phone: clean(data.phone, 40),
    subject: clean(data.subject, 160),
    message: clean(data.message, 3000),
  };

  if (!fields.full_name || !fields.email || !fields.subject || !fields.message) {
    return json(res, 422, { success: false, message: 'Please complete all required contact fields.' });
  }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(fields.email)) {
    return json(res, 422, { success: false, message: 'Please enter a valid email address.' });
  }

  const lines = [
    'New contact message from the Trucking24Fit website.',
    '',
    `Full Name: ${fields.full_name}`,
    `Company Name: ${fields.company_name || '—'}`,
    `Email: ${fields.email}`,
    `Phone: ${fields.phone || '—'}`,
    `Subject: ${fields.subject}`,
    `Message: ${fields.message}`,
  ];

  try {
    await deliver(`Contact Form — ${fields.subject}`, lines.join('\n'), fields.email);
    return json(res, 200, {
      success: true,
      message: 'Thank you. Your message has been sent. We will get back to you soon.',
    });
  } catch (err) {
    console.error(err);
    return json(res, 500, {
      success: false,
      message: 'Unable to process your message right now. Please email contact@trucking24fit.org.',
    });
  }
};
