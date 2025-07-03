@extends('layouts.app')
@section('title', 'Terms and Conditions')
@section('content')
    <section class="flex justify-center items-center">
        <div class="w-full">
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center w-full min-h-[30vh] max-h-[40vh]"
                style="background-image: url('images/sectionimage.jpeg');">

                <!-- User Welcome Section -->
                <div class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-1 py-3 rounded w-[100%] text-white capitalize">
                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-[100%] text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">
                        <div>
                            <p class="font-bold">Terms and Conditions</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <p class="mt-1 text-1xl poppins-light">
                    Welcome to HypeWhip! By accessing or using our services, you agree to comply with and be bound by the following terms and conditions. Please read them carefully.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">1. Acceptance of Terms</h2>
                <p class="mt-2 text-1xl poppins-light">
                    By using our platform, you confirm that you accept these Terms and Conditions and agree to abide by them. If you do not agree to these terms, please refrain from using our services.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">2. User Obligations</h2>
                <p class="mt-2 text-1xl poppins-light">
                    Users are responsible for maintaining the confidentiality of their account information and for all activities that occur under their account. You agree to notify us immediately of any unauthorized use of your account.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">3. Reward System</h2>
                <p class="mt-2 text-1xl poppins-light">
                    HypeWhip rewards users for completing surveys. The details of the rewards system, including eligibility and redemption processes, can be found on our website and are subject to change.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">4. Intellectual Property</h2>
                <p class="mt-2 text-1xl poppins-light">
                    All content, trademarks, and other intellectual property on the HypeWhip platform are owned by us or our licensors. You may not reproduce, distribute, or create derivative works from any content without our prior written consent.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">5. Limitation of Liability</h2>
                <p class="mt-2 text-1xl poppins-light">
                    HypeWhip is not liable for any direct, indirect, incidental, or consequential damages arising from your use of our services. We do not guarantee the accuracy or completeness of the information provided on our platform.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">6. Changes to Terms</h2>
                <p class="mt-2 text-1xl poppins-light">
                    We reserve the right to modify these Terms and Conditions at any time. Any changes will be effective immediately upon posting on our website. Your continued use of our services after such changes constitutes your acceptance of the new terms.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">7. Governing Law</h2>
                <p class="mt-2 text-1xl poppins-light">
                    These Terms and Conditions are governed by the laws of [Your Jurisdiction]. Any disputes arising from these terms will be resolved in the courts of [Your Jurisdiction].
                </p>
            </div>

            <br>
            <br>
            <br>
            <br>
        </div>
    </section>
@endsection
