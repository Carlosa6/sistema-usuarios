<?php require_once "assets/php/header.php"; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-3">
                <?php if($verified == "Verified!"): ?>
                    <div class="card bordermora">
                        <div class="card-header lead text-center bgmora text-white">Send Feedback to Admin!</div>
                        <div class="card-body">
                            <form action="#" method="POST" class="px-4" id="feedback-form">
                                <div class="form-group">
                                    <input type="text" name="subject" placeholder="Write your Subject" class="form-control-lg form-control rounded-0" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="feedback" rows="8" class=" form-control-lg form-control rounded-0" placeholder="Write your feddback here..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Send Feedback" name="feedbackBtn" id="feedbackBtn" class="btn bgmora btn-block btn-lg rounded-0">
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <h1 class="text-center text-secondary mt-5">Verify your E-Mail first to send feedback to Admin!</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- CDN JQUERY.MIN.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <!-- CDN BOOTSTRAP.BUNDLE.MIN.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha512-kBFfSXuTKZcABVouRYGnUo35KKa1FBrYgwG4PAx7Z2Heroknm0ca2Fm2TosdrrI356EDHMW383S3ISrwKcVPUw==" crossorigin="anonymous"></script>
    <!-- CDN JS FONTAWESOME -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
    <!-- CDN SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- CUSTOM JS -->
    <script src="assets/js/feedback.js" type="text/javascript"></script>
</body>

</html>