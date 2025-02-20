<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
<?php include "layout/header.html"; ?>

    
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg md:w-1/2 lg:w-1/3 mx-auto mt-12">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-800">Register</h3>
        <form action="register.php" method="POST" class="space-y-6" onsubmit="return validateForm()">
        
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Enter your full name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <p id="name-error" class="text-red-500 text-sm mt-1 hidden">Nama sudah Dipakai.</p>
            </div>

        
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <p id="email-error" class="text-red-500 text-sm mt-1 hidden">Masukkan alamat email anda.</p>
            </div>

          
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <p id="password-error" class="text-red-500 text-sm mt-1 hidden">Password Minimal 6 karakter</p>
            </div>

        
            <div>
                <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <p id="confirm-password-error" class="text-red-500 text-sm mt-1 hidden">Passwords do not match.</p>
            </div>

       
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="male" class="form-radio h-4 w-4 text-indigo-600" required>
                        <span class="ml-2 text-gray-700">laki laki</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="female" class="form-radio h-4 w-4 text-indigo-600" required>
                        <span class="ml-2 text-gray-700">Perempuan</span>
                    </label>
                </div>
            </div>

           
            <div class="flex items-center">
                <input type="checkbox" name="terms" id="terms" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" required>
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-500">terms and conditions</a>.
                </label>
            </div>
            <p id="terms-error" class="text-red-500 text-sm mt-1 hidden">You must agree to the terms and conditions.</p>

    
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Register
            </button>
        </form>
    </div>

    <script>
        function validateForm() {
            let isValid = true;

            
            const name = document.getElementById('name').value.trim();
            const nameError = document.getElementById('name-error');
            if (name === '') {
                nameError.classList.remove('hidden');
                isValid = false;
            } else {
                nameError.classList.add('hidden');
            }

       
            const email = document.getElementById('email').value.trim();
            const emailError = document.getElementById('email-error');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.classList.remove('hidden');
                isValid = false;
            } else {
                emailError.classList.add('hidden');
            }

          
            const password = document.getElementById('password').value.trim();
            const passwordError = document.getElementById('password-error');
            if (password.length < 6) {
                passwordError.classList.remove('hidden');
                isValid = false;
            } else {
                passwordError.classList.add('hidden');
            }

        
            const confirmPassword = document.getElementById('confirm-password').value.trim();
            const confirmPasswordError = document.getElementById('confirm-password-error');
            if (confirmPassword !== password) {
                confirmPasswordError.classList.remove('hidden');
                isValid = false;
            } else {
                confirmPasswordError.classList.add('hidden');
            }

     
            const terms = document.getElementById('terms').checked;
            const termsError = document.getElementById('terms-error');
            if (!terms) {
                termsError.classList.remove('hidden');
                isValid = false;
            } else {
                termsError.classList.add('hidden');
            }

            return isValid;
        }
    </script>

    <?php include "layout/footer.html"; ?>
    
</body>
</html>