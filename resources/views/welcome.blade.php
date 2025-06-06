<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Business Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom CSS for Offline */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            transition: background-color 0.3s, color 0.3s;
        }

        [data-theme="dark"] {
            background-color: #1f2937;
            color: #f9fafb;
        }

        .card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        [data-theme="dark"] .card {
            background: #374151;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-blue {
            background: #2563eb;
            color: white;
        }

        .btn-blue:hover {
            background: #1d4ed8;
        }

        .btn-orange {
            background: #f97316;
            color: white;
        }

        .btn-orange:hover {
            background: #ea580c;
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(249, 115, 22, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(249, 115, 22, 0);
            }
        }
    </style>
</head>

<body data-theme="light" class="min-h-screen">
    <div class="flex flex-col md:flex-row">
        <nav class="w-full md:w-64 bg-gray-800 text-white p-6 hidden md:block h-screen fixed shadow-lg dark:shadow-gray-900">
            <div class="text-2xl font-bold mb-8 flex items-center gap-2">
                <i data-lucide="bot" class="w-6 h-6"></i>
                Hazza Bot
            </div>
            <ul class="space-y-3">
                <li class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-orange-500 transition duration-200 cursor-pointer">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </li>
                <li class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-orange-500 transition duration-200 cursor-pointer">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Customers</span>
                </li>
                <li class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-orange-500 transition duration-200 cursor-pointer">
                    <i data-lucide="check-square" class="w-5 h-5"></i>
                    <span>Tasks</span>
                </li>
                <li class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-orange-500 transition duration-200 cursor-pointer">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Invoices</span>
                </li>
            </ul>
        </nav>


        <main class="flex-1 p-4 md:p-6 md:ml-64">

            <!-- <main class="flex-1 p-4 md:p-6"> -->
            <header class="flex justify-between items-center mb-6">
                <div>
                    <button class="btn btn-blue mr-2" onclick="toggleSidebar()">☰</button>
                    <button class="btn btn-blue" onclick="toggleTheme()">🌓</button>
                </div>
                <button class="btn btn-orange">Logout</button>
            </header>

            <section class="mb-10">
                <h2 class="text-3xl font-bold mb-6">Dashboard</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="card">
                        <p class="text-gray-500 dark:text-gray-300">Total Customers</p>
                        <p class="text-2xl font-bold mt-4">{{$totalCustomer}}</p>
                    </div>
                    <div class="card">
                        <p class="text-gray-500 dark:text-gray-300">Pending Tasks</p>
                        <p class="text-2xl font-bold mt-4">{{$totalTask}}</p>
                    </div>
                    <div class="card">
                        <p class="text-gray-500 dark:text-gray-300">Unpaid Invoices</p>
                        <p class="text-2xl font-bold mt-4">{{$totalInvoice}}</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 mt-8">
                    <input
                        type="text"
                        id="voiceText"
                        class="flex-1 px-4 py-2 rounded-lg border border-gray-300"
                        placeholder="Record a voice command or type here..." />
                    <button
                        onclick="startListening()"
                        id="micButton"
                        class="btn btn-orange"
                        type="button">
                        🎤 Start
                    </button>
                    <button
                        onclick="stopListening()"
                        id="stopButton"
                        class="btn btn-gray"
                        type="button">
                        ✋ Stop
                    </button>
                </div>

            </section>

            <div class="card">
                <h2 class="text-2xl font-semibold mb-4">Customers</h2>

                @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <a href="{{ route('view') }}" class="btn btn-blue mb-4">+ Add Customer</a>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse mb-8">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Phone</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $customer->name }}</td>
                                <td class="px-4 py-2">{{ $customer->email }}</td>
                                <td class="px-4 py-2">{{ $customer->phone }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('update_view', $customer) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('customer_destroy', $customer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="text-red-500 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h2 class="text-2xl font-semibold mb-4">Tasks</h2>
                <a href="{{ route('tasks.index') }}" class="btn btn-blue mb-4">+ Add Tasks</a>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse mb-8">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 text-left">Title</th>
                                <th class="px-4 py-2 text-left">Assigned To</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Deadline</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $task->title }}</td>
                                <td class="px-4 py-2">{{ $task->customer->name ?? 'Unassigned' }}</td>
                                <td class="px-4 py-2">{{ ucfirst($task->status) }}</td>
                                <td class="px-4 py-2">{{ $task->deadline }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600">Edit</a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete This Task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h2 class="text-2xl font-semibold mb-4">Invoices</h2>
                <a href="{{ route('invoices.create') }}" class="btn btn-blue mb-4">+ Add Invoices</a>
                <table class="w-full table-auto border-collapse mb-8">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Customer</th>
                            <th class="px-4 py-2 text-left">Amount</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">{{ $invoice->id }}</td>
                            <td class="px-4 py-2">{{ $invoice->customer->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">₦{{ $invoice->amount }}</td>
                            <td class="px-4 py-2">{{ $invoice->status }}</td>


                            <td class="px-4 py-2">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600">Edit</a>

                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this invoice?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('nav').classList.toggle('hidden');
        }

        function toggleTheme() {
            const body = document.body;
            const theme = body.dataset.theme === 'light' ? 'dark' : 'light';
            body.dataset.theme = theme;
        }
    </script>
    <script>
        let recognition;
        let isListening = false;

        function startListening() {
            if (isListening) return; // avoid multiple starts
            const mic = document.getElementById('micButton');
            mic.classList.add('pulse');

            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition) {
                alert("Speech Recognition not supported in this browser.");
                mic.classList.remove('pulse');
                return;
            }

            recognition = new SpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;
            recognition.continuous = true; // KEEP LISTENING after speech ends

            recognition.start();
            isListening = true;
            document.getElementById("voiceText").value = "Listening...";

            recognition.onresult = (event) => {
                const transcript = event.results[event.results.length - 1][0].transcript.trim();
                document.getElementById("voiceText").value = "You said: " + transcript;

                // Send command to backend
                fetch("http://127.0.0.1:8000/api/voice-command", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            command: transcript
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message);
                        if (data.action) {
                            window.location.href = data.action;
                        }
                    })
                    .catch(err => alert("Request failed: " + err.message));
            };

            recognition.onerror = (event) => {
                alert("Speech Recognition Error: " + event.error);
                stopListening();
            };

            recognition.onend = () => {
                // If still listening, restart recognition automatically (to handle pauses)
                if (isListening) {
                    recognition.start();
                } else {
                    // Clean up UI when actually stopped
                    const mic = document.getElementById('micButton');
                    mic.classList.remove('pulse');
                    document.getElementById("voiceText").value = "Stopped listening.";
                }
            };
        }

        function stopListening() {
            if (recognition && isListening) {
                isListening = false;
                recognition.stop();
            }
        }
    </script>




    <script>
        lucide.createIcons();
    </script>
</body>

</html>