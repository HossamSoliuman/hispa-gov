import './bootstrap';

const root = document.documentElement;
const page = document.querySelector('.owner-ui');
const themeToggle = document.querySelector('[data-theme-toggle]');
const sidebarTriggers = document.querySelectorAll('[data-sidebar-toggle]');
const storedTheme = localStorage.getItem('owner-theme');
const riyadhTime = document.querySelector('[data-riyadh-time]');
const riyadhDate = document.querySelector('[data-riyadh-date]');
const riyadhTimeFormatter = new Intl.DateTimeFormat('ar-SA-u-ca-gregory-nu-latn', {
    timeZone: 'Asia/Riyadh',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: true,
});
const riyadhDateFormatter = new Intl.DateTimeFormat('ar-SA-u-ca-gregory-nu-latn', {
    timeZone: 'Asia/Riyadh',
    weekday: 'long',
    day: 'numeric',
    month: 'long',
    year: 'numeric',
});

if (storedTheme === 'dark' || storedTheme === 'light') {
    root.dataset.theme = storedTheme;
}

function updateThemeLabel() {
    if (!themeToggle) {
        return;
    }

    const isDark = root.dataset.theme === 'dark';
    themeToggle.setAttribute('aria-label', isDark ? 'تفعيل الوضع الفاتح' : 'تفعيل الوضع الداكن');
    themeToggle.setAttribute('title', isDark ? 'الوضع الفاتح' : 'الوضع الداكن');
}

function closeSidebar() {
    if (page) {
        page.dataset.sidebarOpen = 'false';
    }
}

function updateRiyadhClock() {
    const now = new Date();

    riyadhTime.textContent = riyadhTimeFormatter.format(now);
    riyadhDate.textContent = riyadhDateFormatter.format(now);
}

themeToggle?.addEventListener('click', () => {
    const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';

    root.dataset.theme = nextTheme;
    localStorage.setItem('owner-theme', nextTheme);
    updateThemeLabel();
});

sidebarTriggers.forEach((trigger) => {
    trigger.addEventListener('click', () => {
        if (page) {
            page.dataset.sidebarOpen = page.dataset.sidebarOpen === 'true' ? 'false' : 'true';
        }
    });
});

document.querySelectorAll('[data-print]').forEach((button) => {
    button.addEventListener('click', () => window.print());
});

document.querySelectorAll('[data-dialog-open]').forEach((button) => {
    button.addEventListener('click', () => {
        document.getElementById(button.dataset.dialogOpen)?.showModal();
    });
});

document.querySelectorAll('[data-dialog-close]').forEach((button) => {
    button.addEventListener('click', () => button.closest('dialog')?.close());
});

document.querySelectorAll('dialog[data-auto-open]').forEach((dialog) => dialog.showModal());

document.querySelectorAll('[data-dismissible]').forEach((element) => {
    element.querySelector('[data-dismiss]')?.addEventListener('click', () => element.remove());
});

document.querySelectorAll('[data-multi-select]').forEach((multiSelect) => {
    const label = multiSelect.querySelector('[data-multi-select-label]');
    const checkboxes = [...multiSelect.querySelectorAll('input[type="checkbox"]')];

    const updateLabel = () => {
        const selectedLabels = checkboxes
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.nextElementSibling?.textContent.trim())
            .filter(Boolean);

        if (selectedLabels.length === 0) {
            label.textContent = label.dataset.placeholder;
        } else if (selectedLabels.length === 1) {
            [label.textContent] = selectedLabels;
        } else {
            label.textContent = `تم اختيار ${selectedLabels.length} أدوات`;
        }
    };

    checkboxes.forEach((checkbox) => checkbox.addEventListener('change', updateLabel));
    updateLabel();
});

document.addEventListener('click', (event) => {
    document.querySelectorAll('details[data-multi-select][open]').forEach((multiSelect) => {
        if (!multiSelect.contains(event.target)) {
            multiSelect.removeAttribute('open');
        }
    });
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeSidebar();
    }
});

window.matchMedia('(min-width: 768px)').addEventListener('change', (event) => {
    if (event.matches) {
        closeSidebar();
    }
});

updateThemeLabel();

if (riyadhTime && riyadhDate) {
    updateRiyadhClock();
    window.setInterval(updateRiyadhClock, 1000);
}
