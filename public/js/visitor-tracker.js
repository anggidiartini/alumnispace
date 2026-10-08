/**
 * Visitor Tracking Helper
 * Stores and synchronizes visitor_id (UUID v4) across localStorage and Cookie.
 */
(function () {
    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }

    function setCookie(name, val, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + encodeURIComponent(val) + ';path=/;max-age=' + (days * 24 * 60 * 60) + ';SameSite=Lax';
    }

    function generateUUID() {
        if (typeof crypto !== 'undefined' && crypto.randomUUID) {
            return crypto.randomUUID();
        }
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            const r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    try {
        let visitorId = localStorage.getItem('visitor_id');
        const cookieVisitorId = getCookie('visitor_id');

        if (!visitorId && cookieVisitorId) {
            visitorId = cookieVisitorId;
            localStorage.setItem('visitor_id', visitorId);
        } else if (!visitorId) {
            visitorId = generateUUID();
            localStorage.setItem('visitor_id', visitorId);
        }

        // Always keep cookie in sync with localStorage
        if (cookieVisitorId !== visitorId) {
            setCookie('visitor_id', visitorId, 365);
        }

        window.visitorId = visitorId;
    } catch (e) {
        console.warn('Visitor tracker initialization error:', e);
    }
})();
