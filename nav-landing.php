<style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #2b7d2f; /* Green background */
            margin: 0;
            padding: 0;
        }

        .header-section {
            background-color: #FFFFFF; /* White background for header section */
            border-bottom-left-radius: 50% 100%; /* Half-circle effect */
            border-bottom-right-radius: 50% 100%; /* Half-circle effect */
            padding-top: 20px; /* Adjust this value to control the height of the arc */
            margin-bottom: 20px;
            text-align: center;
        }

        .header-section h5,
        .header-section h1 {
            color: #2b7d2f; /* Green text color */
        }

        .header-section .guide {
            color: #2b7d2f; /* Green text color */
            font-size: 4.5rem; /* Adjust the font size for "Guide" */
            font-weight: bold;
        }

        .header-section .co {
            color: #959722; /* Co text color */
            font-size: 4.5rem; /* Adjust the font size for "Co" */
            font-weight: bold;
        }

        .header-section p {
            color: #FFFFFF; /* White text color */
            font-size: 1.5rem; /* Adjust the font size for paragraph */
        }

        .container .btn-primary {
            background-color: #FFFFFF; /* Button background color */
            color: #2b7d2f; /* Button text color */
            border-color: #2b7d2f; /* Button border color */
            padding: 18px 36px; /* Adjust padding for button */
            font-size: 1.5rem; /* Adjust font size for button text */
            font-weight: bold; /* Make button text bold */
            text-transform: uppercase; /* Convert button text to uppercase */
            width: 70%;
        }
        @media (max-width: 576px) { /* Adjust font sizes for smaller screens like iPhone SE */
            .header-section .guide {
                font-size: 3rem; /* Decrease font size for "Guide" */
            }
            .header-section .co {
                font-size: 3rem; /* Decrease font size for "Co" */
            }
        }
    </style>
</head>

<body>

    <div class="header-section">
        <div class="container mt-5">
            <div class="row justify-content-center pb-4">
                <div class="col-md-8 text-center">
                    <h5>Welcome to</h5>
                    <h1><span class="guide">Guide</span><span class="co">Co</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 text-center">
                <h5 class="text-white">Your hub for expert guidance and counseling. Empower your journey to personal growth with our supportive insights and tools.</h5>
                <a href="login.php" class="btn btn-primary btn-lg mt-5">LOGIN</a>
            </div>
        </div>
    </div>