<?php require_once "assets/php/admin-header.php"; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2" style="border:1px solid #7579e7;">
            <div class="card-header text-white" style="background-color: #7579e7;">
                <h4 class="m-0">Total Registered Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
                    <p class="text-center align-self-center lead">Please wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETALLES DEL USUARIO -->
<div class="modal fade" id="showUserDetailsModal">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getName"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getEmail"></p>
                            <p id="getPhone"></p>
                            <p id="getDob"></p>
                            <p id="getGender"></p>
                            <p id="getCreated"></p>
                            <p id="getVerified"></p>
                        </div>
                    </div>
                    <div class="card align-self-center" id="getImage"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER AREA -->
</div>
</div>
</div>

<!-- SCRIPTS JS -->
<?php require_once "assets/php/scripts.php"; ?>

<!-- CUSTOM JS -->
<script src="assets/js/users-admin.js"></script>

</body>

</html>