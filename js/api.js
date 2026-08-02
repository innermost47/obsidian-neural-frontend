const API_URL = window.APP_CONFIG?.API_URL || "http://localhost:8000/api/v1";

const API = {
  async register(email, password, acceptNewsUpdates = true) {
    try {
      const response = await fetch(`${API_URL}/auth/register`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          email,
          password,
          accept_news_updates: acceptNewsUpdates,
        }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async login(email, password) {
    try {
      const response = await fetch(`${API_URL}/auth/login`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async verify2FA(tempToken, code) {
    try {
      const response = await fetch(`${API_URL}/auth/login/2fa`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ temp_token: tempToken, code }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async googleLogin() {
    try {
      const response = await fetch(`${API_URL}/auth/google/login`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        throw new Error("Google login failed");
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async verifyEmail(token) {
    try {
      const response = await fetch(`${API_URL}/auth/verify-email/${token}`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async resendVerification(email) {
    try {
      const response = await fetch(`${API_URL}/auth/resend-verification`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async forgotPassword(email) {
    try {
      const response = await fetch(`${API_URL}/auth/forgot-password`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async resetPassword(token, newPassword) {
    try {
      const response = await fetch(`${API_URL}/auth/reset-password`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ token, new_password: newPassword }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async getMe() {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/me`, {
        headers: { Authorization: `Bearer ${token}` },
        credentials: "omit",
      });
      if (!response.ok) {
        throw new Error("Unauthorized");
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw new Error("Network error");
      }
      throw error;
    }
  },

  async getCurrentUser() {
    return this.getMe();
  },

  async setup2FA() {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/2fa/setup`, {
        method: "POST",
        headers: { Authorization: `Bearer ${token}` },
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async verifySetup2FA(code) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/2fa/verify-setup`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ code }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async disable2FA(code) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/2fa/disable`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ code }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async createCheckout(tier) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/auth/subscription/create-checkout`,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
          body: JSON.stringify({ tier }),
          credentials: "omit",
        },
      );
      if (!response.ok) {
        throw new Error("Checkout failed");
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw new Error("Network error");
      }
      throw error;
    }
  },

  async getCustomerPortal() {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/subscription/portal`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${token}`,
        },
        credentials: "omit",
      });
      if (!response.ok) {
        throw new Error("Failed to get portal");
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw new Error("Network error");
      }
      throw error;
    }
  },

  async deleteAccount() {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/account/delete`, {
        method: "DELETE",
        headers: {
          Authorization: `Bearer ${token}`,
        },
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async sendContactMessage(name, email, subject, message, honeypots) {
    try {
      const response = await fetch(`${API_URL}/contact`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          name,
          email,
          subject,
          message,
          ...honeypots,
        }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async updatePreferences(acceptNewsUpdates) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/auth/preferences`, {
        method: "PATCH",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ accept_news_updates: acceptNewsUpdates }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error" };
      }
      throw error;
    }
  },

  async purchaseGift(giftData) {
    try {
      const response = await fetch(`${API_URL}/gifts/purchase`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(giftData),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async checkGiftCode(giftCode) {
    try {
      const response = await fetch(`${API_URL}/gifts/check/${giftCode}`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async activateGift(giftCode) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/gifts/activate/${giftCode}`, {
        method: "POST",
        headers: {
          Authorization: `Bearer ${token}`,
        },
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },
  async getBroadcastRecipientsCount() {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/broadcast/recipients-count`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async sendBroadcastEmail(subject, body) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/admin/broadcast/send`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ subject, body }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getBroadcastHistory() {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/admin/broadcast/history`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${token}`,
        },
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getBroadcastDetail(emailId) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/broadcast/history/${emailId}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getAnalyticsOverview(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/overview?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getAnalyticsDaily(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/daily?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getTopPages(days = 30, limit = 10) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/pages?days=${days}&limit=${limit}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getTrafficSources(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/sources?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getDeviceBreakdown(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/devices?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },
  async getCountries(days = 30, limit = 10) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/countries?days=${days}&limit=${limit}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getConversionFunnel(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/funnel?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getSocialReferrals(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/analytics/social?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getEmailStats(days = 30) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/emails/stats?days=${days}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getEmailLogs({
    page = 1,
    limit = 50,
    status = "",
    email_type = "",
    search = "",
  }) {
    const token = localStorage.getItem("token");
    const params = new URLSearchParams({
      page: page.toString(),
      limit: limit.toString(),
    });

    if (status) params.append("status", status);
    if (email_type) params.append("email_type", email_type);
    if (search) params.append("search", search);

    try {
      const response = await fetch(`${API_URL}/admin/emails/logs?${params}`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${token}`,
        },
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getFailedEmails(limit = 100) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/emails/failed?limit=${limit}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async retryEmails(emailIds) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/admin/emails/retry`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({ email_ids: emailIds }),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getEmailDetail(emailId) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/admin/emails/detail/${emailId}`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async deleteEmailLog(emailId) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(`${API_URL}/admin/emails/logs/${emailId}`, {
        method: "DELETE",
        headers: {
          Authorization: `Bearer ${token}`,
        },
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async cleanupOldEmailLogs(days = 90, status = null) {
    const token = localStorage.getItem("token");
    const params = new URLSearchParams({ days: days.toString() });
    if (status) params.append("status", status);

    try {
      const response = await fetch(
        `${API_URL}/admin/emails/logs/cleanup?${params}`,
        {
          method: "DELETE",
          headers: {
            Authorization: `Bearer ${token}`,
          },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async listProviders() {
    const token = localStorage.getItem("token");
    const response = await fetch(`${API_URL}/admin/providers/`, {
      headers: { Authorization: `Bearer ${token}` },
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async addProvider(name, url, stripe_account_id, user_id) {
    const token = localStorage.getItem("token");
    const response = await fetch(`${API_URL}/admin/providers/`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        name,
        url,
        stripe_account_id: stripe_account_id || null,
        user_id: user_id ? parseInt(user_id) : null,
      }),
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async getProviderOnboardingLink(id) {
    const token = localStorage.getItem("token");
    const response = await fetch(
      `${API_URL}/admin/providers/${id}/onboarding-link`,
      {
        method: "POST",
        headers: { Authorization: `Bearer ${token}` },
        credentials: "omit",
      },
    );
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async deleteProvider(id) {
    const token = localStorage.getItem("token");
    const response = await fetch(`${API_URL}/admin/providers/${id}`, {
      method: "DELETE",
      headers: { Authorization: `Bearer ${token}` },
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async getProviderStats() {
    const token = localStorage.getItem("token");
    const response = await fetch(`${API_URL}/providers/my-stats`, {
      headers: { Authorization: `Bearer ${token}` },
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async getAdminStats() {
    const response = await fetch(`${API_URL}/admin/stats`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async getAdminUsers() {
    const response = await fetch(`${API_URL}/admin/users`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async getAdminUser(userId) {
    const response = await fetch(`${API_URL}/admin/users/${userId}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
      credentials: "omit",
    });
    if (!response.ok) throw await response.json();
    return await response.json();
  },

  async getLicenseBySession(sessionId) {
    try {
      const response = await fetch(
        `${API_URL}/license/by-session/${sessionId}`,
        {
          method: "GET",
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw { ...error, status: response.status };
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw {
          detail: "Network error. Please check your connection.",
          status: 0,
        };
      }
      throw error;
    }
  },

  async releaseLicenseMachine(licenseKey, machineId) {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${API_URL}/license/${encodeURIComponent(licenseKey)}/machine/${encodeURIComponent(machineId)}`,
        {
          method: "DELETE",
          headers: { Authorization: `Bearer ${token}` },
          credentials: "omit",
        },
      );
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async checkLicenseCountUnder500() {
    try {
      const response = await fetch(`${API_URL}/license/count/under-500`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async createLocalCheckout(email = null, promoCode = null) {
    try {
      const body = {};
      if (email) body.email = email;
      if (promoCode) body.promo_code = promoCode;
      const response = await fetch(`${API_URL}/license/checkout`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(body),
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async checkLocalDownload(platform, sessionId = null) {
    const token = localStorage.getItem("token");
    const params = new URLSearchParams({ platform });
    if (sessionId) params.append("session_id", sessionId);

    const headers = {};
    if (!sessionId && token) headers.Authorization = `Bearer ${token}`;

    try {
      const response = await fetch(
        `${API_URL}/license/download/check?${params}`,
        { method: "GET", headers, credentials: "omit" },
      );
      if (!response.ok) {
        const error = await response.json().catch(() => ({}));
        throw { ...error, status: response.status };
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw {
          detail: "Network error. Please check your connection.",
          status: 0,
        };
      }
      throw error;
    }
  },

  async getVersions(platform = null, includePrereleases = false) {
    const params = new URLSearchParams();
    if (platform) params.append("platform", platform);
    if (includePrereleases) params.append("include_prereleases", "true");

    try {
      const response = await fetch(`${API_URL}/license/versions?${params}`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json().catch(() => ({}));
        throw { ...error, status: response.status };
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw {
          detail: "Network error. Please check your connection.",
          status: 0,
        };
      }
      throw error;
    }
  },

  async checkLocalDownloadVersion(platform, version) {
    const token = localStorage.getItem("token");
    const params = new URLSearchParams({ platform, version });

    const headers = {};
    if (token) headers.Authorization = `Bearer ${token}`;

    try {
      const response = await fetch(
        `${API_URL}/license/download/check?${params}`,
        { method: "GET", headers, credentials: "omit" },
      );
      if (!response.ok) {
        const error = await response.json().catch(() => ({}));
        throw { ...error, status: response.status };
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw {
          detail: "Network error. Please check your connection.",
          status: 0,
        };
      }
      throw error;
    }
  },

  async getLicenseCountTotal() {
    try {
      const response = await fetch(`${API_URL}/license/count/total`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  async getPublicGrowth() {
    try {
      const response = await fetch(`${API_URL}/public/growth`, {
        method: "GET",
        credentials: "omit",
      });
      if (!response.ok) {
        const error = await response.json();
        throw error;
      }
      return await response.json();
    } catch (error) {
      if (error instanceof TypeError) {
        throw { detail: "Network error. Please check your connection." };
      }
      throw error;
    }
  },

  getLocalDownloadUrl(sessionId, platform) {
    return `${API_URL}/license/download?session_id=${encodeURIComponent(
      sessionId,
    )}&platform=${encodeURIComponent(platform)}`;
  },

  getLicenseDownloadUrl(platform) {
    const token = localStorage.getItem("token");
    return `${API_URL}/license/download?platform=${encodeURIComponent(platform)}&token=${encodeURIComponent(token)}`;
  },
};

function showDownloadError(err, elementId) {
  const el = document.getElementById(elementId);
  if (!el) return;
  let message;
  if (err.status === 429) {
    message = "Too many attempts — please wait a minute and try again.";
  } else if (err.status === 403) {
    message = "We couldn't verify your license. Please contact support.";
  } else if (err.status === 404) {
    message = "This build isn't available right now. Please contact support.";
  } else {
    message = err.detail || "Something went wrong. Please try again.";
  }
  el.textContent = message;
  el.classList.remove("hidden");
}

function hideDownloadError(elementId) {
  const el = document.getElementById(elementId);
  if (el) el.classList.add("hidden");
}
