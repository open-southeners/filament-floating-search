<div
    class="inline-block"
    aria-modal="true"
    role="dialog"
    x-trap.noscroll="isOpen"
    x-data="{
        isOpen: false,

        close: function () {
            this.isOpen = false
        },

        open: function () {
            console.log('open')
            this.$nextTick(() => {
                this.isOpen = true
            })
        },
    }"
    x-on:keydown.meta.k.document="open()"
    x-bind:class="{
        'fi-modal-open': isOpen,
    }"
>
    <div x-cloak x-show="isOpen">
        <div
            aria-hidden="true"
            x-show="isOpen"
            x-transition.duration.300ms.opacity
            @class([
                'fi-modal-close-overlay fixed inset-0 z-40 bg-gray-950/50 dark:bg-gray-950/75',
            ])
        ></div>

        <div class="fixed inset-0 z-40 overflow-y-auto cursor-pointer">
            <div
                class="relative grid min-h-full grid-rows-[1fr_auto_1fr] justify-items-center sm:grid-rows-[1fr_auto_3fr] p-4"
                x-ref="modalContainer"
                x-on:click.self="
                    document.activeElement.selectionStart === undefined &&
                        document.activeElement.selectionEnd === undefined &&
                        close
                "
            >
                <div
                    x-data="{ isShown: false }"
                    x-init="
                        $nextTick(() => {
                            isShown = isOpen
                            $watch('isOpen', () => (isShown = isOpen))
                        })
                    "
                    x-show="isShown"
                    x-on:keydown.window.escape="close"
                    x-transition:enter="duration-300"
                    x-transition:leave="duration-300"
                    x-transition:enter-start="scale-95 opacity-0"
                    x-transition:enter-end="scale-100 opacity-100"
                    x-transition:leave-start="scale-100 opacity-100"
                    x-transition:leave-end="scale-95 opacity-0"
                    class="fi-modal-window pointer-events-auto relative mx-auto row-start-2 flex w-full cursor-default flex-col h-[100dvh] max-w-xl"
                >
                    <div class="fi-modal-content flex flex-1 flex-col gap-y-4 py-12">
                        @livewire(Filament\Livewire\GlobalSearch::class)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
document.addEventListener('alpine:init', () => {
    console.log('alpine initialized')
    document.addEventListener('keydown', (event) => {
        if (event.key === 'k' && event.metaKey) {
            $dispatch('open-modal', { id: 'floating-search-modal' })
            // document.querySelector('#floating-search-bar').classList.toggle('visible');
            // document.querySelector('#floating-search-bar').classList.toggle('invisible');
        }
    })
})
</script> -->
