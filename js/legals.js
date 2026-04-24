const c = window.APP_CONFIG;
document.getElementById("legal-name").textContent = c.COMPANY_NAME;
document.getElementById("legal-status").textContent = c.COMPANY_STATUS;
document.getElementById("legal-address").textContent = c.COMPANY_ADDRESS;
document.getElementById("legal-siret").textContent = c.COMPANY_SIRET;
document.getElementById("legal-email").textContent = c.COMPANY_EMAIL;
document.getElementById("legal-email").href = "mailto:" + c.COMPANY_EMAIL;
document.getElementById("legal-vat").textContent = c.COMPANY_VAT;
document.getElementById("legal-director").textContent = c.PUBLICATION_DIRECTOR;
document.getElementById("legal-host-name").textContent = c.HOST_NAME;
document.getElementById("legal-host-address").textContent = c.HOST_ADDRESS;
document.getElementById("legal-host-phone").textContent = c.HOST_PHONE;
document.getElementById("legal-host-url").textContent = c.HOST_URL;
document.getElementById("legal-host-url").href = c.HOST_URL;
document.getElementById("legal-updated").textContent = c.LEGAL_LAST_UPDATED;
document.getElementById("legal-contact-email").href =
  "mailto:" + c.COMPANY_EMAIL;
document.getElementById("legal-ip-text").textContent = c.LEGAL_IP_TEXT;
