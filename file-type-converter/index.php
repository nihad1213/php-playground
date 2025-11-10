<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Own Resume</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Create Your Resume</h1>
            <p class="text-gray-600">Fill in your information and download in your preferred format</p>
        </div>

        <!-- Form Container -->
        <form class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            
            <!-- Personal Information Section -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                    Personal Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="full_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="john@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="+1 234 567 8900">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="New York, USA">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn / Website</label>
                        <input type="url" name="website" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="https://linkedin.com/in/johndoe">
                    </div>
                </div>
            </div>

            <!-- Professional Summary -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                    Professional Summary
                </h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Summary</label>
                    <textarea name="summary" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Brief description of your professional background and career objectives..."></textarea>
                </div>
            </div>

            <!-- Work Experience -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                    Work Experience
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                                <input type="text" name="job_title_1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Senior Developer">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                                <input type="text" name="company_1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Tech Corp">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input type="text" name="start_date_1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Jan 2020">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="text" name="end_date_1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Present">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="job_description_1" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Key responsibilities and achievements..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center mr-3 text-sm">4</span>
                    Education
                </h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                            <input type="text" name="degree" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Bachelor of Computer Science">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Institution</label>
                            <input type="text" name="institution" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="University Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <input type="text" name="graduation_year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="2019">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">GPA (Optional)</label>
                            <input type="text" name="gpa" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="3.8/4.0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center mr-3 text-sm">5</span>
                    Skills
                </h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Skills (comma-separated)</label>
                    <textarea name="skills" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="PHP, JavaScript, Laravel, React, MySQL, Git..."></textarea>
                </div>
            </div>

            <!-- Download Options -->
            <div class="pt-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center mr-3 text-sm">6</span>
                    Download Format
                </h2>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" name="format" value="word" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                        <span>Download as Word (.docx)</span>
                    </button>
                    <button type="submit" name="format" value="pdf" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-6 rounded-lg transition duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20M10.92,12.31C10.68,11.54 10.15,9.08 11.55,9.04C12.95,9 12.03,12.16 12.03,12.16C12.42,13.65 14.05,14.72 14.05,14.72C14.55,14.57 17.4,14.24 17,15.72C16.57,17.2 13.5,15.81 13.5,15.81C11.55,15.95 10.09,16.47 10.09,16.47C8.96,18.58 7.64,19.5 7.1,18.61C6.43,17.5 9.23,16.07 9.23,16.07C10.68,13.72 10.9,12.35 10.92,12.31Z"/>
                        </svg>
                        <span>Download as PDF</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-600 text-sm">
            <p>Fill in all fields for the best resume output</p>
        </div>
    </div>
</body>
</html>