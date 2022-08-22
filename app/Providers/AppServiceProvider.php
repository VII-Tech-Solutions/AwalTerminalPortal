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
        $homePageContentId = HomepageContent::all()->first()->id;
        $tourPageContentId = TourTheTerminalContent::all()->first()->id;
        $OurStoryPageContentId = OurStoryContent::all()->first()->id;
        $servicesPageContentId = ServicesContent::all()->first()->id;
        $generalAviationPageContentId = GeneralAviationContent::all()->first()->id;
        $eliteServicesPageContentId = EliteServicesContent::all()->first()->id;
        $contactUsPageContentId = ContactUsContent::all()->first()->id;

        Filament::serving(function () use ($homePageContentId, $tourPageContentId, $OurStoryPageContentId, $servicesPageContentId, $generalAviationPageContentId, $eliteServicesPageContentId, $contactUsPageContentId) {
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
                            ->url("$appUrl/admin/homepage-contents/$homePageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),
                        NavigationItem::make()->label('Tour page')
                            ->url("$appUrl/admin/tour-the-terminal-contents/$tourPageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),
                        NavigationItem::make()->label('Our story page')
                            ->url("$appUrl/admin/our-story-contents/$OurStoryPageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),
                        NavigationItem::make()->label('Services page')
                            ->url("$appUrl/admin/services-contents/$servicesPageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),
                        NavigationItem::make()->label('General aviation page')
                            ->url("$appUrl/admin/general-aviation-contents/$generalAviationPageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),
                        NavigationItem::make()->label('Elite services page')
                            ->url("$appUrl/admin/elite-services-contents/$eliteServicesPageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),
                        NavigationItem::make()->label('Contact us page')
                            ->url("$appUrl/admin/contact-us-contents/$contactUsPageContentId/edit")
                            ->icon('heroicon-o-collection')
                            ->group("Website Content"),

                    ]);
                }
            }
        });
    }
}
