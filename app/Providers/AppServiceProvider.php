<?php

namespace App\Providers;

use App\Constants\AdminUserType;
use App\Models\ContactUsContent;
use App\Models\EliteServicesContent;
use App\Models\GeneralAviationContent;
use App\Models\HomepageContent;
use App\Models\OurStoryContent;
use App\Models\ServicesContent;
use App\Models\TourTheTerminalContent;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        };

        $homePageContent = HomepageContent::all()->first();
        $tourPageContent = TourTheTerminalContent::all()->first();
        $OurStoryPageContent = OurStoryContent::all()->first();
        $servicesPageContent = ServicesContent::all()->first();
        $generalAviationPageContent = GeneralAviationContent::all()->first();
        $eliteServicesPageContent = EliteServicesContent::all()->first();
        $contactUsPageContent = ContactUsContent::all()->first();
        if (!is_null($homePageContent) && !is_null($tourPageContent) && !is_null($OurStoryPageContent) && !is_null($servicesPageContent) && !is_null($generalAviationPageContent) && !is_null($eliteServicesPageContent) && !is_null($contactUsPageContent)) {
            Filament::serving(function () use ($homePageContent, $tourPageContent, $OurStoryPageContent, $servicesPageContent, $generalAviationPageContent, $eliteServicesPageContent, $contactUsPageContent) {
                $appUrl = ENV('APP_URL');
                Filament::registerNavigationGroups([
                    '',
                    'Submissions',
                    'Metadata',
                ]);
                /** @var User $user */
                $user = auth()->user();
                if (!is_null($user)) {
                    if ($user->canAccess(AdminUserType::MODERATOR)) {
                        Filament::registerNavigationItems([
                            NavigationItem::make()->label('Homepage')
                                ->url("$appUrl/admin/homepage-contents/$homePageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),
                            NavigationItem::make()->label('Tour page')
                                ->url("$appUrl/admin/tour-the-terminal-contents/$tourPageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),
                            NavigationItem::make()->label('Our story page')
                                ->url("$appUrl/admin/our-story-contents/$OurStoryPageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),
                            NavigationItem::make()->label('Services page')
                                ->url("$appUrl/admin/services-contents/$servicesPageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),
                            NavigationItem::make()->label('General aviation page')
                                ->url("$appUrl/admin/general-aviation-contents/$generalAviationPageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),
                            NavigationItem::make()->label('Elite services page')
                                ->url("$appUrl/admin/elite-services-contents/$eliteServicesPageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),
                            NavigationItem::make()->label('Contact us page')
                                ->url("$appUrl/admin/contact-us-contents/$contactUsPageContent->id/edit")
                                ->icon('heroicon-o-collection')
                                ->group("Website Content"),

                        ]);
                    }
                }
            });
        }
    }
}
