    <script>
        function confirmLogout() {
            return confirm('Are you sure you want to log out?');
        }

        function hideSignUpButton() {
            var signUpButton = document.getElementById('signup');
            signUpButton.parentNode.removeChild(signUpButton);
        }
    </script>
