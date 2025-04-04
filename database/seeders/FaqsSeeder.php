<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faqs')->insert([
            // Business Intelligence (BI) Overview
            ['question' => 'What is Business Intelligence (BI)?', 'answer' => 'Business Intelligence (BI) refers to the process of collecting, analyzing, and presenting business data to help organizations make informed decisions.', 'is_active' => true],
            ['question' => 'How can Business Intelligence benefit my company?', 'answer' => 'BI helps businesses improve decision-making, optimize operations, enhance customer experiences, and identify growth opportunities through data-driven insights.', 'is_active' => true],
            ['question' => 'What industries can benefit from Business Intelligence?', 'answer' => 'Almost every industry, including finance, healthcare, retail, manufacturing, and marketing, can leverage BI to improve efficiency and profitability.', 'is_active' => true],
            ['question' => 'What are the key components of a Business Intelligence system?', 'answer' => 'BI systems typically include data warehousing, data analytics, reporting tools, dashboards, and visualization platforms.', 'is_active' => true],
            ['question' => 'Is Business Intelligence only for large enterprises?', 'answer' => 'No. Businesses of all sizes can benefit from BI tools, as modern solutions offer scalable and cost-effective options tailored to small and medium enterprises.', 'is_active' => true],
            ['question' => 'What are some popular BI tools?', 'answer' => 'Common BI tools include Microsoft Power BI, Tableau, Google Data Studio, Looker, and SAP BusinessObjects.', 'is_active' => true],
            ['question' => 'How does Business Intelligence differ from Data Analytics?', 'answer' => 'BI focuses on reporting and visualization of historical and real-time data, while data analytics involves deeper statistical analysis, including predictive modeling and AI-driven insights.', 'is_active' => true],
            ['question' => 'Can Business Intelligence integrate with my existing software?', 'answer' => 'Yes, most BI tools integrate with CRM systems, ERP software, cloud services, and databases to streamline data collection and reporting.', 'is_active' => true],
            ['question' => 'How long does it take to implement a BI solution?', 'answer' => 'Implementation time varies based on the complexity of your data and business needs, but it can take anywhere from a few weeks to several months.', 'is_active' => true],
            ['question' => 'Do you offer training and support for BI tools?', 'answer' => 'Yes, we provide training sessions, user guides, and technical support to help your team maximize the benefits of BI solutions.', 'is_active' => true],
            // Website Development and Management
            ['question' => 'Why does my business need a website?', 'answer' => 'A website improves credibility, enhances visibility, provides a platform for customer engagement, and allows businesses to showcase their products and services.', 'is_active' => true],
            ['question' => 'What services do you offer for website development?', 'answer' => 'We offer custom website design, e-commerce development, CMS integration, SEO optimization, and website maintenance services.', 'is_active' => true],
            ['question' => 'How long does it take to build a website?', 'answer' => 'The timeline depends on the complexity of the website. A basic website can take 2–4 weeks, while complex projects can take several months.', 'is_active' => true],
            ['question' => 'Can I update my website myself after it’s built?', 'answer' => 'Yes. We build websites with user-friendly content management systems (CMS) like WordPress or custom admin panels so you can easily update content.', 'is_active' => true],
            ['question' => 'Do you provide website maintenance and support?', 'answer' => 'Yes, we offer ongoing maintenance, security updates, content updates, and technical support to ensure your website runs smoothly.', 'is_active' => true],
            ['question' => 'What is the cost of building a website?', 'answer' => 'Costs vary based on features, complexity, and design requirements. We offer tailored pricing packages to fit your budget.', 'is_active' => true],
            ['question' => 'Will my website be mobile-friendly?', 'answer' => 'Yes, all our websites are fully responsive and optimized for mobile, tablet, and desktop viewing.', 'is_active' => true],
            ['question' => 'Can you redesign my existing website?', 'answer' => 'Absolutely! We can revamp outdated websites with a fresh design, better UX/UI, and improved functionality.', 'is_active' => true],
            ['question' => 'Do you provide SEO services to help my website rank on Google?', 'answer' => 'Yes, we offer SEO strategies, including keyword optimization, content marketing, and technical SEO, to improve your search engine ranking.', 'is_active' => true],
            // Payment Methods, Policies, and Trials
            ['question' => 'What payment methods do you accept?', 'answer' => 'We accept bank transfers, credit/debit cards, PayPal, and mobile payment solutions. Flexible payment plans are available for large projects.', 'is_active' => true],
            ['question' => 'Do you offer free trials or demos of your services?', 'answer' => 'Yes, we provide free demos of our BI solutions and limited-time trials for website services so you can explore our offerings before committing.', 'is_active' => true],
            ['question' => 'What is your refund policy?', 'answer' => 'Refunds are available within a specified period for unused services. Custom development projects may have different refund terms outlined in our contract.', 'is_active' => true],
            ['question' => 'Can I pay in installments for larger projects?', 'answer' => 'Yes, we offer flexible installment plans for projects exceeding a certain amount. Contact us for customized payment options.', 'is_active' => true],
            ['question' => 'Do you offer subscription-based services for website management or BI tools?', 'answer' => 'Yes, we offer subscription-based plans for website maintenance, BI dashboards, and data analytics services.', 'is_active' => true],
            ['question' => 'What happens if I miss a payment?', 'answer' => 'We provide a grace period for overdue payments. After the grace period, services may be suspended until payment is received.', 'is_active' => true],
            ['question' => 'Are there hidden charges in your pricing?', 'answer' => 'No, we provide transparent pricing with no hidden fees. Any additional costs are clearly communicated before project commencement.', 'is_active' => true],
            ['question' => 'Can I cancel my subscription at any time?', 'answer' => 'Yes, you can cancel subscriptions at any time. However, certain contracts may require a minimum commitment period.', 'is_active' => true],
            ['question' => 'Do you offer discounts for long-term contracts?', 'answer' => 'Yes, we provide discounts for clients who sign long-term contracts for website management or BI consulting services.', 'is_active' => true],
            ['question' => 'Is my payment information secure?', 'answer' => 'Absolutely. We use secure payment gateways and encryption to protect your payment information.', 'is_active' => true],
            ['question' => 'How do I get an invoice for my payment?', 'answer' => 'Invoices are automatically generated and sent to your registered email upon successful payment.', 'is_active' => true],
            // miscellenious
            ['question' => 'What is your refund policy?', 'answer' => 'We offer a 30-day refund policy for all services.', 'is_active' => true],
            ['question' => 'How can I contact support?', 'answer' => 'You can reach our support team via email at support@example.com.', 'is_active' => true],
            ['question' => 'Do you provide custom development services?', 'answer' => 'Yes, we offer tailored solutions based on your needs.', 'is_active' => true],
            ['question' => 'Is there a free trial available?', 'answer' => 'Yes, we offer a 14-day free trial for new users.', 'is_active' => true],
            ['question' => 'What payment methods do you accept?', 'answer' => 'We accept credit cards, PayPal, and bank transfers.', 'is_active' => true],
        ]);
    }
}
