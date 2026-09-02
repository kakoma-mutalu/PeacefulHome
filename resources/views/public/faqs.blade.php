@extends('layouts.public')

@section('content')
    <x-public-page-title
        eyebrow="Frequently asked questions"
        title="Helpful answers for clients and families."
        text="Please contact Peaceful Home for guidance specific to your circumstances."
    />

    @php
        $faqCategories = [
            'General' => [
                'What is Peaceful Home?' => 'Peaceful Home Rehabilitation Centre provides private, professional recovery-focused support in Lusaka.',
                'Where is Peaceful Home located?' => 'Meanwood Ndeke Phase 1, Lusaka, Zambia.',
                'How do I get started?' => 'Call, WhatsApp, submit an enquiry or make a reservation online.',
            ],
            'Treatment' => [
                'What types of treatment are available?' => 'We offer addiction treatment support, mental health support, behavioural therapy, relapse prevention, family support and aftercare, subject to assessment.',
                'How long does rehabilitation take?' => 'It varies by individual circumstances and programme suitability.',
                'Can family members participate?' => 'Family involvement may be arranged where appropriate, with consent and facility policy.',
            ],
            'Admission' => [
                'How do I make a reservation?' => 'Choose a programme or service, submit your information and preferred date, then wait for confirmation.',
                'What should I bring?' => 'Identification, relevant medical and medication information, emergency contacts, and approved clothing and toiletries.',
            ],
            'Payments' => [
                'How much does treatment cost?' => 'Programme fees displayed online are indicative and must be confirmed with Peaceful Home.',
                'Can I pay through Airtel Money?' => 'Airtel Money payment architecture is being prepared. Online requests remain pending until payment is confirmed.',
                'What happens if a payment fails?' => 'No payment is recorded as received. Contact Peaceful Home to discuss payment arrangements.',
            ],
            'Confidentiality' => [
                'Is my information confidential?' => 'Peaceful Home treats enquiries respectfully and limits access to authorised personnel as appropriate.',
                'Who can access my information?' => 'Access is limited according to operational need, consent and applicable policy.',
            ],
            'Family' => [
                'Can family members visit or communicate?' => 'Arrangements are confirmed with Peaceful Home and consider client wellbeing, consent and policy.',
            ],
            'Emergency' => [
                'Does Peaceful Home handle emergencies?' => 'Rehabilitation support is not a substitute for emergency medical care. If someone is in immediate danger or experiencing a medical emergency, contact local emergency services or go to the nearest emergency department.',
            ],
        ];
    @endphp

    <section class="section">
        <div class="container">
            <div class="accordion" id="faq">
                @foreach ($faqCategories as $categoryIndex => $questions)
                    <h2 class="faq-category">{{ $categoryIndex }}</h2>

                    @foreach ($questions as $questionIndex => $answer)
                        @php($faqId = 'faq-'.$loop->parent->iteration.'-'.$loop->iteration)
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="{{ $faqId }}-heading">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $faqId }}"
                                    aria-expanded="false"
                                    aria-controls="{{ $faqId }}"
                                >
                                    {{ $questionIndex }}
                                </button>
                            </h3>
                            <div
                                id="{{ $faqId }}"
                                class="accordion-collapse collapse"
                                aria-labelledby="{{ $faqId }}-heading"
                                data-bs-parent="#faq"
                            >
                                <div class="accordion-body">{{ $answer }}</div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection
