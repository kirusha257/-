<footer class="footer">
    <div class="footer-content">
        <div class="footer-logo-click" id="adminSecretButton">
            {{ __('messages.vkucno') }}
        </div>

        <div class="contacts-short">
            {{ $contact->localized_address ?? '' }}<br>
            {{ $contact->phone ?? '' }}<br>
            {{ $contact->localized_work_hours ?? '' }}
        </div>
    </div>
</footer>

<div id="adminToast" class="admin-toast">
    🔐 Админ-панель
</div>

<script>
    let clickCount = 0;
    let timeoutId = null;

    const logoBtn = document.getElementById('adminSecretButton');
    const toast = document.getElementById('adminToast');

    if (logoBtn) {
        logoBtn.addEventListener('click', () => {
            clickCount++;

            clearTimeout(timeoutId);

            timeoutId = setTimeout(() => {
                clickCount = 0;
            }, 1000);

            if (clickCount === 5) {
                toast.textContent = '✅ Перенаправление на страницу входа...';
                toast.style.opacity = '1';

                setTimeout(() => {
                    toast.style.opacity = '0';
                }, 2000);

                window.location.href = "{{ route('admin.login') }}";

                clickCount = 0;
            }
        });
    }
</script>