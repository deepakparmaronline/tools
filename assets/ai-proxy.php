<?php
// API ko JSON format mein respond karne ke liye set kiya
header('Content-Type: application/json');

// Yahan apni Hugging Face API key daalo (Ye server par safe rahegi)
$apiKey = "YOUR_HF_TOKEN_HERE"; 

// Hugging Face ka model URL (Tum isko Llama ya kisi aur model se badal sakte ho)
$apiUrl = "https://api-inference.huggingface.co/models/mistralai/Mistral-7B-Instruct-v0.2";

// User ka IP address aur aaj ki date nikali
$userIp = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');

// Limit track karne ke liye ek folder banaya
$limitDir = __DIR__ . '/limits';
if (!is_dir($limitDir)) {
    mkdir($limitDir, 0755, true);
}

// Har IP aur date ke hisaab se ek alag file banegi
$ipFile = $limitDir . '/' . md5($userIp) . '_' . $date . '.txt';
$usageCount = 0;

if (file_exists($ipFile)) {
    $usageCount = (int)file_get_contents($ipFile);
}

// Agar 5 bar use ho gaya hai, toh error bhej do
if ($usageCount >= 5) {
    echo json_encode(['error' => 'Bhai, aaj ki limit (5/5) khatam ho gayi hai. Kal wapas aana!']);
    exit;
}

// Frontend se aaya hua prompt read kiya
$input = json_decode(file_get_contents('php://input'), true);
$prompt = $input['prompt'] ?? '';

if (empty($prompt)) {
    echo json_encode(['error' => 'Prompt khali hai. Kuch toh likho!']);
    exit;
}

// Hugging Face ko securely request bheji (cURL ka use karke)
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["inputs" => $prompt]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    // Agar response successful hai, toh hit count badha do
    $usageCount++;
    file_put_contents($ipFile, $usageCount);
    echo $response;
} else {
    echo json_encode(['error' => 'API request fail ho gayi.', 'details' => json_decode($response)]);
}
?>