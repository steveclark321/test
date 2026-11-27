(() => {
  "use strict";

  const header = document.querySelector(".site-header");
  const toggle = document.querySelector(".nav-toggle");
  const nav = document.querySelector(".primary-nav");
  const toast = document.getElementById("toast");

  // Mobile navigation
  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const open = !nav.classList.contains("is-open");
      nav.classList.toggle("is-open", open);
      document.body.classList.toggle("nav-open", open);
      toggle.setAttribute("aria-expanded", String(open));
      toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
    });

    nav.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        nav.classList.remove("is-open");
        document.body.classList.remove("nav-open");
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", "Open menu");
      });
    });
  }

  // Sticky header shadow
  const onScroll = () => {
    if (!header) return;
    header.style.boxShadow = window.scrollY > 8 ? "0 8px 24px rgba(6,13,24,0.25)" : "none";
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  // Reveal on scroll
  const reveals = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window && reveals.length) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
    );
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-visible"));
  }

  function showToast(message, type = "success") {
    if (!toast) {
      window.alert(message);
      return;
    }
    toast.hidden = false;
    toast.textContent = message;
    toast.className = `toast is-visible is-${type}`;
    clearTimeout(showToast._timer);
    showToast._timer = setTimeout(() => {
      toast.classList.remove("is-visible");
      setTimeout(() => {
        toast.hidden = true;
      }, 300);
    }, 5200);
  }

  function setFieldError(group, message) {
    group.classList.toggle("is-invalid", Boolean(message));
    const err = group.querySelector(".error-text");
    if (err) err.textContent = message || "";
  }

  function validateEmail(value) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
  }

  function validateForm(form) {
    let valid = true;
    form.querySelectorAll(".form-group").forEach((group) => {
      const field = group.querySelector("input, select, textarea");
      if (!field || field.type === "hidden" || field.name === "website_url") return;

      const required = field.hasAttribute("required");
      const value = field.value.trim();
      let message = "";

      if (required && !value) {
        message = "This field is required.";
      } else if ((field.type === "email" || field.name.includes("email")) && value && !validateEmail(value)) {
        message = "Enter a valid email address.";
      } else if (field.type === "tel" && value && value.replace(/\D/g, "").length < 10) {
        message = "Enter a valid phone number.";
      }

      setFieldError(group, message);
      if (message) valid = false;
    });
    return valid;
  }

  async function submitForm(form) {
    const endpoint = form.getAttribute("action") || form.dataset.endpoint;
    if (!endpoint) return;

    if (!validateForm(form)) {
      showToast("Please correct the highlighted fields and try again.", "error");
      const firstInvalid = form.querySelector(".form-group.is-invalid input, .form-group.is-invalid select, .form-group.is-invalid textarea");
      if (firstInvalid) firstInvalid.focus();
      return;
    }

    const submitBtn = form.querySelector('[type="submit"]');
    const original = submitBtn ? submitBtn.textContent : "";
    if (submitBtn) {
      submitBtn.classList.add("is-loading");
      submitBtn.disabled = true;
      submitBtn.textContent = "Sending…";
    }

    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    try {
      const res = await fetch(endpoint, {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify(payload),
      });

      let data = {};
      try {
        data = await res.json();
      } catch (_) {
        data = {};
      }

      if (!res.ok || !data.success) {
        throw new Error(data.message || "Something went wrong. Please try again.");
      }

      showToast(data.message || "Submitted successfully.", "success");
      form.reset();
      form.querySelectorAll(".form-group").forEach((g) => setFieldError(g, ""));
    } catch (err) {
      showToast(err.message || "Unable to submit right now. Please call or email us.", "error");
    } finally {
      if (submitBtn) {
        submitBtn.classList.remove("is-loading");
        submitBtn.disabled = false;
        submitBtn.textContent = original;
      }
    }
  }

  document.querySelectorAll("form[data-ajax='true']").forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(form);
    });

    form.querySelectorAll("input, select, textarea").forEach((field) => {
      field.addEventListener("blur", () => {
        const group = field.closest(".form-group");
        if (!group) return;
        // Re-validate single field context via full form scan of that group
        const required = field.hasAttribute("required");
        const value = field.value.trim();
        let message = "";
        if (required && !value) message = "This field is required.";
        else if ((field.type === "email" || field.name.includes("email")) && value && !validateEmail(value)) {
          message = "Enter a valid email address.";
        }
        setFieldError(group, message);
      });
    });
  });

  // Smooth in-page focus for hash links
  if (location.hash) {
    const target = document.querySelector(location.hash);
    if (target) {
      setTimeout(() => target.scrollIntoView({ behavior: "smooth", block: "start" }), 100);
    }
  }
})();
