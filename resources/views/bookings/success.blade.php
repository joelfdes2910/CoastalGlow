<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <script>
    window.onload = function () {
        const newTab = window.open("{{ $pdfUrl }}", "_blank");

        // Delay redirect to dashboard to give PDF time to open
        setTimeout(function () {
            window.location.href = "{{ route('customer.dashboard') }}";
        }, 10000); // delay in ms (1.5 seconds)
    }
</script>

</head>
<body>
    <h2>Generating your booking confirmation PDF...</h2>
    <p>If the PDF doesn't open, <a href="{{ $pdfUrl }}" target="_blank">click here</a>.</p>
</body>
</html>
