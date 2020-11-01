<?php require_once "assets/php/header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if($verified == "Not Verified!"): ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-3 m-0">
                        <button class="close" type="button" data-dismiss="alert">&times;</button>
                        <strong>Your E-mail is not verified! We've sent you an E-mail Verification link on your E-mail, check & verify now!</strong>
                    </div>
                <?php endif; ?>
                <h4 class="text-center text-primary my-3">Write Your Notes Here & Access Anytime Anywhere!</h4>
            </div>
        </div>
        <div class="card border-primary">
            <h5 class="card-header bgprimario d-flex justify-content-between align-items-center">
                <span class="text-light lead">All Notes</span>
                <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add New Note</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive" id="showNote">
                    <!-- Tabla de notas del usuario que se inyectará con JS -->
                    <p class="text-center lead mt-5">Please wait...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Inicio Modal Add New Note -->
    <div class="modal fade" id="addNoteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bgexito">
                    <h4 class="modal-title text-light">Add New Note</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="add-note-form" class="px-3">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <textarea name="note" class="form-control form-control-lg" placeholder="Write Your Note Here..." rows="6" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Note" name="addNote" id="addNoteBtn" class="btn btn-success btn-block btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Add New Note -->

    <!-- Inicio Modal Edit Note -->
    <div class="modal fade" id="editNoteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bgadvert">
                    <h4 class="modal-title text-light">Edit Note</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit-note-form" class="px-3">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <textarea name="note" id="note" class="form-control form-control-lg" placeholder="Write Your Note Here..." rows="6" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Note" name="editNote" id="editNoteBtn" class="btn btn-warning btn-block btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Edit Note -->

    <!-- CDN JQUERY.MIN.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <!-- CDN BOOTSTRAP.BUNDLE.MIN.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha512-kBFfSXuTKZcABVouRYGnUo35KKa1FBrYgwG4PAx7Z2Heroknm0ca2Fm2TosdrrI356EDHMW383S3ISrwKcVPUw==" crossorigin="anonymous"></script>
    <!-- CDN JS FONTAWESOME -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
    <!-- CDN JS DATATABLE -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <!-- CDN SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- CUSTOM JS -->
    <script type="text/javascript" src="assets/js/home.js"></script>
</body>

</html>