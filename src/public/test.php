<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiHi - Le Test</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">LOGO</a>
        </div>
    </header>

    <main class="test-container">
        <p class="section-subtitle">QUESTIONS</p>

        <div class="question-box">
            <h2 class="question-text">[ QUESTION SELECTIONNEE ]</h2>

            <form action="test.php" method="POST" class="choices-form">
                <!-- L'ID de la question en cours peut être passé en champ caché -->
                <input type="hidden" name="id_question" value="1">

                <div class="choices-list">
                    <label class="choice-item">
                        <input type="radio" name="id_choix" value="1" required>
                        <span class="choice-label">[CHOIX A]</span>
                    </label>

                    <label class="choice-item">
                        <input type="radio" name="id_choix" value="2">
                        <span class="choice-label">[CHOIX B]</span>
                    </label>

                    <label class="choice-item">
                        <input type="radio" name="id_choix" value="3">
                        <span class="choice-label">[CHOIX C]</span>
                    </label>

                    <label class="choice-item">
                        <input type="radio" name="id_choix" value="4">
                        <span class="choice-label">[CHOIX D]</span>
                    </label>
                </div>

                <div class="test-navigation">
                    <span class="question-counter">QUESTION 1 / 10</span>
                    <button type="submit" class="btn-primary">SUITE</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
