     </div>
     <footer>
         <div class="footer-area">
             <p>© Copyright 2020. All right reserved.</p>
         </div>
     </footer>


     </div>
     <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
     <!-- bootstrap 4 js -->
     <script src="../assets/js/popper.min.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>
     <script src="../assets/js/owl.carousel.min.js"></script>
     <script src="../assets/js/metisMenu.min.js"></script>
     <script src="../assets/js/jquery.slimscroll.min.js"></script>
     <script src="../assets/js/jquery.slicknav.min.js"></script>

     <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

     <!-- others plugins -->
     <script src="../assets/js/plugins.js"></script>
     <script src="../assets/js/scripts.js"></script>
     
     <script>
         $('#full-view-tutorial').on('click', function() {
             window.open('../tutorial.html');
         });
         $('#tutorialBtn').on('click', function() {
             <?php if ($_SESSION['role'] == 'Guru') { ?>
             window.open('../admin/tutorial.php');
             <?php } ?>
             <?php if ($_SESSION['role'] == 'Peserta') { ?>
             window.open('../peserta/tutorial.php');
             <?php } ?>
         });
     </script>

     <script>
         $('#tombol-notif').on("click", function() {
             <?php
                unset($_SESSION['notif']);
                unset($_SESSION['notif_type']);
                ?>
         })
     </script>