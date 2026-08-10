<!DOCTYPE html>
<html>
<head>
    <title>Klaim Baru</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Ada Klaim Baru! 🎉</h2>

    <p>Halo, {{ $claim->food->restaurant->business_name }}</p>

    <p>
        <strong>{{ $claim->user->name }}</strong> baru saja mengklaim makanan
        <strong>"{{ $claim->food->name }}"</strong> milik Anda.
    </p>

    <p>Silakan buka Dashboard Restaurant Anda untuk menerima atau menolak klaim ini.</p>

    <p>
        <a href="{{ route('restaurant.dashboard') }}" style="background: #22c55e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Buka Dashboard
        </a>
    </p>

    <hr>
    <small>Email ini dikirim otomatis oleh FoodBridge.</small>
</body>
</html>