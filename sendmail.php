<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>ご連絡ありがとうございます</title>

        <link rel="stylesheet" href="style/style.css">
    </head>

    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // フォームから送信されたデータを受け取る
                $name = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
                $message = htmlspecialchars($_POST["coments"], ENT_QUOTES, 'UTF-8');

            // 送信先のメールアドレス
                $to = "takayasu.style@gmail.com";

            // メールの件名
                $subject = "ハナワWEBからお問い合わせがありました";
                $subject = mb_encode_mimeheader($subject, "UTF-8");

            // メール本文
                $body = "お名前: $name\n";
                $body .= "メールアドレス: $email\n";
                $body .= "メッセージ:\n$message";
                $body = mb_convert_encoding($body, "ISO-2022-JP", "UTF-8");

            // ヘッダー
                $headers = "From: noreply@hdw-demosite.ready.jp\r\n"; // 送信元は固定にする方が望ましい
                $headers .= "Reply-To: $email\r\n"; // ユーザーの返信先を指定
                $headers .= "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
                $headers .= "Content-Transfer-Encoding: 7bit\r\n"; 

            // メールを送信する
                if (mail($to, $subject, $body, $headers)) {
                    echo '<div class="res frame">
                        <p>ご入力いただきましたお名前とメールアドレスを担当者に送信しました。</p>
                        <p>24時間以内に担当からご連絡差し上げます。</p>
                        <p><a href="index.html">戻る</a></p>
                        </div>';
                } else {
                    echo "<p>メールの送信に失敗しました</p>";
                }
            }
        ?>

    </body>
</html>