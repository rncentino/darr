<script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>


        <script>
               const passwordToggle = document.querySelector('.password-toggle');
const passwordInput = document.getElementById('password');

passwordToggle.addEventListener('click', function () {
  
  passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';

  
  this.classList.toggle('ti-eye'); 
});


        </script>