<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProviderProfile;
use App\Models\ProviderService;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        // ── Step 1: Categories ──
        $categories = [
            ['name' => 'Electrician',   'icon' => 'fas fa-bolt',         'description' => 'Electrical wiring, repairs and installations'],
            ['name' => 'Plumber',       'icon' => 'fas fa-faucet',       'description' => 'Pipe fitting, leakage fixing and water supply'],
            ['name' => 'Carpenter',     'icon' => 'fas fa-hammer',       'description' => 'Furniture making, woodwork and door repairs'],
            ['name' => 'Painter',       'icon' => 'fas fa-paint-roller', 'description' => 'Interior and exterior painting services'],
            ['name' => 'AC Technician', 'icon' => 'fas fa-wind',         'description' => 'AC installation, servicing and gas refilling'],
            ['name' => 'Cleaner',       'icon' => 'fas fa-broom',        'description' => 'Home, office and deep cleaning services'],
        ];

        $serviceIds = [];
        foreach ($categories as $cat) {
            $service = Service::firstOrCreate(
                ['name' => $cat['name']],
                ['icon' => $cat['icon'], 'description' => $cat['description']]
            );
            $serviceIds[$cat['name']] = $service->id;
        }

        // ── Step 2: Provider Data ──
        $providers = [
            [
                'user'    => ['name' => 'Ahmed Raza',    'email' => 'ahmed.raza@handyhub.pk'],
                'profile' => ['organization_name' => 'Raza Electricals',       'organization_type' => 'Sole Proprietor', 'phone' => '0301-1234567', 'city' => 'Lahore',     'province' => 'Punjab',  'address' => 'Gulberg III, Lahore',          'description' => '10+ saal ka experience. Ghar, daftar aur factory ki wiring mein mahir. Emergency service 24/7.', 'is_verified' => true],
                'services' => [['category' => 'Electrician',   'title' => 'Ghar ki Complete Wiring & Rewiring',       'description' => 'Naye ghar ki mukammal wiring ya purani wiring replace. Load calculation, DB board fitting, earthing shamil.', 'experience' => '10 Saal']],
            ],
            [
                'user'    => ['name' => 'Usman Tariq',   'email' => 'usman.tariq@handyhub.pk'],
                'profile' => ['organization_name' => 'Tariq Electric Works',   'organization_type' => 'Partnership',     'phone' => '0311-2345678', 'city' => 'Karachi',    'province' => 'Sindh',   'address' => 'PECHS Block 6, Karachi',        'description' => 'Solar panel, UPS/inverter setup aur industrial wiring mein expert. Team of 5 certified electricians.', 'is_verified' => true],
                'services' => [['category' => 'Electrician',   'title' => 'Solar Panel & Inverter Installation',      'description' => 'Ghar aur factory ke liye solar system. Net metering, battery backup setup bhi karta hoon.',             'experience' => '7 Saal']],
            ],
            [
                'user'    => ['name' => 'Bilal Hassan',  'email' => 'bilal.hassan@handyhub.pk'],
                'profile' => ['organization_name' => 'Hassan Power Solutions', 'organization_type' => 'Sole Proprietor', 'phone' => '0321-3456789', 'city' => 'Islamabad',  'province' => 'Federal', 'address' => 'G-10 Markaz, Islamabad',        'description' => 'CCTV, burglar alarm aur smart home automation systems. NTDC certified electrician.', 'is_verified' => true],
                'services' => [['category' => 'Electrician',   'title' => 'CCTV & Smart Home Automation',             'description' => 'IP cameras, smart switches, home automation complete setup. Remote monitoring available.',                 'experience' => '5 Saal']],
            ],
            [
                'user'    => ['name' => 'Zubair Khan',   'email' => 'zubair.khan@handyhub.pk'],
                'profile' => ['organization_name' => 'Khan Plumbing Services', 'organization_type' => 'Sole Proprietor', 'phone' => '0332-4567890', 'city' => 'Lahore',     'province' => 'Punjab',  'address' => 'Model Town, Lahore',            'description' => 'Leakage fix, pipe fitting, bathroom renovation mein 8 saal ka tajurba. Same day service Lahore.', 'is_verified' => true],
                'services' => [['category' => 'Plumber',       'title' => 'Leakage Fixing & Pipe Replacement',        'description' => 'Roof leakage, underground pipe leakage, bathroom fitting repair. UPVC, CPVC, GI pipes ka kaam.',      'experience' => '8 Saal']],
            ],
            [
                'user'    => ['name' => 'Imran Butt',    'email' => 'imran.butt@handyhub.pk'],
                'profile' => ['organization_name' => 'Butt Plumbing & Sanitation', 'organization_type' => 'Sole Proprietor', 'phone' => '0345-5678901', 'city' => 'Faisalabad', 'province' => 'Punjab', 'address' => 'D-Ground, Faisalabad',         'description' => 'Sewerage blockage, drain cleaning, water tank installation mein specialist. WAPDA approved.', 'is_verified' => true],
                'services' => [['category' => 'Plumber',       'title' => 'Sewerage & Drain Cleaning',                'description' => 'Blocked drain machine se saaf karna, manhole cleaning, sewerage line. Industrial equipment use.',       'experience' => '12 Saal']],
            ],
            [
                'user'    => ['name' => 'Nadeem Iqbal',  'email' => 'nadeem.carpenter@handyhub.pk'],
                'profile' => ['organization_name' => 'Iqbal Wood Works',       'organization_type' => 'Sole Proprietor', 'phone' => '0312-7890123', 'city' => 'Lahore',     'province' => 'Punjab',  'address' => 'Johar Town, Lahore',            'description' => 'Custom furniture, kitchen cabinets, wardrobe design mein 15 saal ka experience. Quality guarantee.', 'is_verified' => true],
                'services' => [['category' => 'Carpenter',     'title' => 'Custom Kitchen Cabinets & Wardrobes',      'description' => 'PVC, melamine aur wood ki custom kitchen units, wardrobes. Design se installation tak.',               'experience' => '15 Saal']],
            ],
            [
                'user'    => ['name' => 'Asif Rehman',   'email' => 'asif.wood@handyhub.pk'],
                'profile' => ['organization_name' => 'Rehman Furniture Studio','organization_type' => 'Partnership',     'phone' => '0322-8901234', 'city' => 'Multan',     'province' => 'Punjab',  'address' => 'Gulgasht Colony, Multan',       'description' => 'Beds, sofas, dining tables banata hoon. Repair aur polish bhi. Home delivery free.', 'is_verified' => false],
                'services' => [['category' => 'Carpenter',     'title' => 'Furniture Repair & Polish',                'description' => 'Purana furniture repair, naya polish, broken parts replace. Sofa re-upholstery available.',             'experience' => '9 Saal']],
            ],
            [
                'user'    => ['name' => 'Farhan Ali',    'email' => 'farhan.painter@handyhub.pk'],
                'profile' => ['organization_name' => 'Ali Painting Services',  'organization_type' => 'Sole Proprietor', 'phone' => '0333-9012345', 'city' => 'Karachi',    'province' => 'Sindh',   'address' => 'North Karachi Sector 11-C',     'description' => 'Interior, exterior aur texture painting. Weather coat specialist. Professional team.', 'is_verified' => true],
                'services' => [['category' => 'Painter',       'title' => 'Interior & Exterior Wall Painting',        'description' => 'Dulux, Berger paint. Putty, primer aur 2 coats included. Clean work guarantee.',                       'experience' => '11 Saal']],
            ],
            [
                'user'    => ['name' => 'Kamran Malik',  'email' => 'kamran.paint@handyhub.pk'],
                'profile' => ['organization_name' => 'Malik Decor Studio',     'organization_type' => 'Sole Proprietor', 'phone' => '0344-0123456', 'city' => 'Islamabad',  'province' => 'Federal', 'address' => 'F-7 Markaz, Islamabad',         'description' => '3D wall art, wallpaper fitting, stencil design, epoxy flooring mein maahir.', 'is_verified' => true],
                'services' => [['category' => 'Painter',       'title' => '3D Wall Art & Wallpaper Fitting',          'description' => 'Custom 3D designs, imported wallpapers, feature walls. Kids room, bedroom decoration.',                  'experience' => '6 Saal']],
            ],
            [
                'user'    => ['name' => 'Waqas Saleem',  'email' => 'waqas.ac@handyhub.pk'],
                'profile' => ['organization_name' => 'Cool Breeze HVAC',       'organization_type' => 'Partnership',     'phone' => '0355-1234560', 'city' => 'Lahore',     'province' => 'Punjab',  'address' => 'DHA Phase 5, Lahore',           'description' => 'AC installation, servicing, gas filling. Haier, Gree, Dawlance certified technician.', 'is_verified' => true],
                'services' => [['category' => 'AC Technician', 'title' => 'AC Installation & Gas Filling',            'description' => 'Split AC, cassette, window AC install. R-22, R-32, R-410A gas filling. Copper piping included.',       'experience' => '8 Saal']],
            ],
            [
                'user'    => ['name' => 'Junaid Awan',   'email' => 'junaid.hvac@handyhub.pk'],
                'profile' => ['organization_name' => 'Awan Cooling Solutions', 'organization_type' => 'Sole Proprietor', 'phone' => '0366-2345671', 'city' => 'Rawalpindi', 'province' => 'Punjab',  'address' => 'Saddar, Rawalpindi',            'description' => 'AC servicing, cleaning, PCB repair. Industrial chillers aur VRF systems bhi.', 'is_verified' => true],
                'services' => [['category' => 'AC Technician', 'title' => 'AC Deep Cleaning & Annual Servicing',      'description' => 'Complete AC tune-up, coil washing, filter cleaning, thermostat check. Performance guarantee.',          'experience' => '10 Saal']],
            ],
            [
                'user'    => ['name' => 'Tariq Mehmood', 'email' => 'tariq.clean@handyhub.pk'],
                'profile' => ['organization_name' => 'SparkClean Services',    'organization_type' => 'Partnership',     'phone' => '0377-3456782', 'city' => 'Karachi',    'province' => 'Sindh',   'address' => 'Clifton Block 4, Karachi',      'description' => 'Professional cleaning team of 8. Deep cleaning, sofa shampooing, kitchen degreasing, marble polishing.', 'is_verified' => true],
                'services' => [['category' => 'Cleaner',       'title' => 'Home Deep Cleaning & Sofa Shampooing',     'description' => 'Poore ghar ki deep cleaning, sofa/carpet shampoo, kitchen degreasing, bathroom sanitizing.',           'experience' => '7 Saal']],
            ],
            [
                'user'    => ['name' => 'Hassan Mirza',  'email' => 'hassan.clean@handyhub.pk'],
                'profile' => ['organization_name' => 'PureHome Cleaning',      'organization_type' => 'Sole Proprietor', 'phone' => '0388-4567893', 'city' => 'Lahore',     'province' => 'Punjab',  'address' => 'Bahria Town, Lahore',           'description' => 'Post-construction cleaning, move-in/out cleaning expert. Industrial vacuum aur steam machines.', 'is_verified' => false],
                'services' => [['category' => 'Cleaner',       'title' => 'Post-Construction & Move-in Cleaning',     'description' => 'Construction ke baad ki gandgi saaf. Paint stains, cement, dust remove. Ready-to-live-in deliver.',   'experience' => '5 Saal']],
            ],
        ];

        // ── Step 3: Save to DB ──
        $created = 0; $updated = 0;

        foreach ($providers as $data) {

            // Create or find user
            $user = User::firstOrCreate(
                ['email' => $data['user']['email']],
                [
                    'name'     => $data['user']['name'],
                    'password' => Hash::make('password123'),
                    'role'     => 'provider',
                ]
            );

            // Add profile if missing
            if (! ProviderProfile::where('user_id', $user->id)->exists()) {
                ProviderProfile::create([
                    'user_id'           => $user->id,
                    'organization_name' => $data['profile']['organization_name'],
                    'organization_type' => $data['profile']['organization_type'],
                    'phone'             => $data['profile']['phone'],
                    'city'              => $data['profile']['city'],
                    'province'          => $data['profile']['province'],
                    'address'           => $data['profile']['address'],
                    'description'       => $data['profile']['description'],
                    'is_verified'       => $data['profile']['is_verified'],
                    'profile_completed' => true,
                ]);
                $this->command->info(" Profile added: {$data['user']['name']}");
            }

            // Add services if missing
            foreach ($data['services'] as $svc) {
                $catId = $serviceIds[$svc['category']] ?? null;
                if (! $catId) continue;

                $exists = ProviderService::where('provider_id', $user->id)
                    ->where('service_id', $catId)->exists();

                if (! $exists) {
                    ProviderService::create([
                        'provider_id' => $user->id,
                        'service_id'  => $catId,
                        'title'       => $svc['title'],
                        'description' => $svc['description'],
                        'experience'  => $svc['experience'],
                    ]);
                    $this->command->info("   🔧 Service added: {$svc['title']}");
                    $updated++;
                }
            }

            $created++;
        }

        $this->command->newLine();
        $this->command->info("══════════════════════════════════════");
        $this->command->info("  {$created} providers processed");
        $this->command->info("  {$updated} services added");
        $this->command->info("  Password: password123");
        $this->command->info("══════════════════════════════════════");
    }
}