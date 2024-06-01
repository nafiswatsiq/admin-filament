<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->
        <div>
            <p>Hello pak</p>
            <div id="qr-reader" style="width:500px"></div>
            <div id="qr-reader-results"></div>
            
            <input x-model="state" />
      
            <script src="https://unpkg.com/html5-qrcode"></script>
            <script>
                var resultContainer = document.getElementById('qr-reader-results');
                var lastResult, countResults = 0;
      
                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText !== lastResult) {
                        ++countResults;
                        lastResult = decodedText;
                        // Handle on success condition with the decoded message.
                        console.log(`Scan result ${decodedText}`, decodedResult);
      
                        Livewire.dispatch('qr-scanned', {
                            'qr': decodedText,
                        });

                    }
                }
      
                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess);
            </script>
        </div>
    </div>
</x-dynamic-component>
