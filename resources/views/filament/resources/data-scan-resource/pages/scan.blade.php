<x-filament-panels::page>
  <div class="max-w-lg mx-auto w-full">
    <div id="qr-reader" class="w-full"></div>
    <div id="qr-reader-results"></div>

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
</x-filament-panels::page>
