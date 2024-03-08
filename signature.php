<?php
$data = '{
        "action": "call",
        "destinationNumber": "082122071292",
        "callback_url": "http://api.trada.id:3000/test",
        "caller_id": null,
        "extension": "9910300",
        "systemid": "740450639"
    }';
    
    $privateKeyPath = 'API/KEY/private_key.pem'; // Ganti dengan jalur lengkap berkas private_key.pem
    
    $signature = '';
    $privateKey = openssl_pkey_get_private(file_get_contents($privateKeyPath));
    
    if (openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
        $base64Signature = base64_encode($signature);
        echo 'Base64 Signature: ' . $base64Signature . "\n";
    } else {
        echo "Failed to sign the data.";
    }

    
?>