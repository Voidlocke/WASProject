<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server Error</title>
</head>
<body>
    <main style="max-width: 720px; margin: 60px auto; font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; line-height: 1.5;">
        <h1 style="margin-bottom: 8px;">Something went wrong</h1>
        <p style="margin-top: 0;">We couldn't complete your request right now. Please try again.</p>
        <p><a href="{{ url()->previous() }}">Go back</a></p>
    </main>
</body>
</html>
