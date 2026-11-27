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
  // Prefer Resend when configured; otherwise FormSubmit ajax relay to company inbox.
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

  // Honeypot
  if (clean(data.website_url, 200)) {
    return json(res, 200, { success: true, message: 'Thank you. Your request has been received.' });
  }

  const fields = {
    full_name: clean(data.full_name, 120),
    company_name: clean(data.company_name, 160),
    business_email: clean(data.business_email, 160),
    phone: clean(data.phone, 40),
    pickup_location: clean(data.pickup_location, 200),
    delivery_location: clean(data.delivery_location, 200),
    freight_type: clean(data.freight_type, 120),
    equipment_required: clean(data.equipment_required, 120),
    estimated_weight: clean(data.estimated_weight, 80),
    number_of_pallets: clean(data.number_of_pallets, 40),
    pickup_date: clean(data.pickup_date, 40),
    delivery_date: clean(data.delivery_date, 40),
    additional_details: clean(data.additional_details, 2000),
  };

  const required = [
    'full_name',
    'company_name',
    'business_email',
    'phone',
    'pickup_location',
    'delivery_location',
    'freight_type',
    'equipment_required',
  ];
  for (const key of required) {
    if (!fields[key]) {
      return json(res, 422, { success: false, message: 'Please complete all required quote fields.' });
    }
  }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(fields.business_email)) {
    return json(res, 422, { success: false, message: 'Please enter a valid business email address.' });
  }

  const lines = [
    'New freight quote request from the Trucking24Fit website.',
    '',
    `Full Name: ${fields.full_name}`,
    `Company Name: ${fields.company_name}`,
    `Business Email: ${fields.business_email}`,
    `Phone: ${fields.phone}`,
    `Pickup Location: ${fields.pickup_location}`,
    `Delivery Location: ${fields.delivery_location}`,
    `Freight Type: ${fields.freight_type}`,
    `Equipment Required: ${fields.equipment_required}`,
    `Estimated Weight: ${fields.estimated_weight || '—'}`,
    `Number of Pallets: ${fields.number_of_pallets || '—'}`,
    `Pickup Date: ${fields.pickup_date || '—'}`,
    `Delivery Date: ${fields.delivery_date || '—'}`,
    `Additional Details: ${fields.additional_details || '—'}`,
  ];

  try {
    await deliver(`Freight Quote Request — ${fields.company_name}`, lines.join('\n'), fields.business_email);
    return json(res, 200, {
      success: true,
      message: 'Thank you. Your quote request has been submitted. Our team will follow up shortly.',
    });
  } catch (err) {
    console.error(err);
    return json(res, 500, {
      success: false,
      message: 'Unable to process your request right now. Please email contact@trucking24fit.org.',
    });
  }
};
