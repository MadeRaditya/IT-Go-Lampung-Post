{{-- Shadcn-style Floating Toast Notification Container --}}
<div id="toast-container"
    class="fixed top-20 right-4 sm:right-6 z-[100] flex flex-col gap-2.5 max-w-sm sm:max-w-md w-full pointer-events-none transition-all">
</div>

<script>
    (function() {
        const container = document.getElementById('toast-container');

        const icons = {
            success: `
                <div class="w-8 h-8 rounded-lg bg-emerald-950/80 border border-emerald-500/40 text-emerald-400 flex items-center justify-center shrink-0 shadow-sm shadow-emerald-950">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            `,
            error: `
                <div class="w-8 h-8 rounded-lg bg-rose-950/80 border border-rose-500/40 text-rose-400 flex items-center justify-center shrink-0 shadow-sm shadow-rose-950">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            `,
            info: `
                <div class="w-8 h-8 rounded-lg bg-blue-950/80 border border-blue-500/40 text-blue-400 flex items-center justify-center shrink-0 shadow-sm shadow-blue-950">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            `
        };

        function createToast(type = 'success', title = 'Pemberitahuan', message = '') {
            const toast = document.createElement('div');
            toast.className = [
                'pointer-events-auto',
                'bg-[#0f172a]/95 backdrop-blur-md',
                'border border-[#1e293b]',
                'text-slate-100',
                'p-3.5 sm:p-4 rounded-xl',
                'shadow-xl shadow-black/50',
                'flex items-start gap-3',
                'transition-all duration-300 transform translate-x-4 opacity-0'
            ].join(' ');

            toast.innerHTML = `
                ${icons[type] || icons.info}
                <div class="flex-1 min-w-0 pt-0.5">
                    <h5 class="text-xs font-bold text-white tracking-tight">${title}</h5>
                    <p class="text-xs text-slate-300 mt-0.5 leading-relaxed break-words">${message}</p>
                </div>
                <button type="button" class="shrink-0 text-slate-400 hover:text-white p-1 rounded-lg transition" aria-label="Tutup">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

            const closeBtn = toast.querySelector('button');
            function dismiss() {
                toast.classList.add('opacity-0', 'translate-x-4');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }

            closeBtn.addEventListener('click', dismiss);

            container.appendChild(toast);

            // Trigger animation in next frame
            requestAnimationFrame(() => {
                toast.classList.remove('opacity-0', 'translate-x-4');
            });

            // Auto dismiss after 4.5 seconds
            setTimeout(dismiss, 4500);
        }

        // Global toast object
        window.toast = {
            success: (msg, title = 'Berhasil!') => createToast('success', title, msg),
            error: (msg, title = 'Terjadi Kesalahan') => createToast('error', title, msg),
            info: (msg, title = 'Informasi') => createToast('info', title, msg)
        };

        // Render Laravel flash sessions
        @if (session('success'))
            window.toast.success({!! json_encode(session('success')) !!});
        @endif

        @if (session('error'))
            window.toast.error({!! json_encode(session('error')) !!});
        @endif

        @if (session('status'))
            window.toast.info({!! json_encode(session('status')) !!});
        @endif

        @if ($errors->any())
            window.toast.error({!! json_encode($errors->first()) !!}, 'Validasi Gagal');
        @endif
    })();
</script>
