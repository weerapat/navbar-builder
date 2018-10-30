<?php

namespace App\Http\Controllers\NavigationBar;

use App\Http\Controllers\Controller;
use App\Models\NavigationBar\NavigationBar;
use App\Models\NavigationBar\NavigationBarSetting;
use App\Http\Requests\NavigationBar\SaveSettingRequest;
use App\Models\NavigationBar\Service\NavigationBarFactory;
use Illuminate\Http\JsonResponse;

class NavigationBarController extends Controller
{
    /** @var NavigationBarFactory */
    private $navigationBarFactory;
    public function __construct(NavigationBarFactory $navigationBarFactory)
    {
        $this->navigationBarFactory = $navigationBarFactory;
    }
    public function index()
    {
        return view('pages.navbar-cms.index');
    }
    /**
     * Get Navigation Bar
     *
     * @return JsonResponse
     */
    public function get()
    {
        $navigationBar = NavigationBar::find(1);
        if (!$navigationBar) {
            return response()->json([]);
        }
        $navigationBar = $navigationBar->bar;
        return response()->json($navigationBar);
    }
    /**
     * Get Navigation Bar Setting
     *
     * @return JsonResponse
     */
    public function getSetting()
    {
        $setting = NavigationBarSetting::find(1);
        if (!$setting) {
            return response()->json(null);
        }
        $setting = $setting->toArray();
        unset($setting['id']);
        return response()->json($setting);
    }
    /**
     * Save Navigation Bar Setting
     *
     * @param SaveSettingRequest $request
     *
     * @return JsonResponse
     */
    public function saveSetting(SaveSettingRequest $request)
    {
        $data = $request->all();
        // semantic check
        $itemOrders = [];
        foreach ($data['items'] as $itemKey => &$item) {
            $itemOrder = $item['order'];
            if ($itemOrder !== null && in_array($itemOrder, $itemOrders, false)) {
                abort(422, "Order must be unique for item.[{$itemKey}]");
            } else {
                $itemOrders[] = $itemOrder;
            }
            $pageOrders = [];
            if (array_key_exists('pages', $item) && $item['pages'] !== null) {
                foreach ($item['pages'] as $pageKey => $page) {
                    $pageOrder = $page['order'];
                    if ($pageOrder !== null && in_array($pageOrder, $pageOrders, false)) {
                        abort(422, "Order must be unique for item.[{$itemKey}].page.[{$pageKey}]");
                    } else {
                        $pageOrders[] = $pageOrder;
                    }
                }
            }
            $promotionOrders = [];
            if (array_key_exists('promotions', $item) && $item['promotions'] !== null) {
                foreach ($item['promotions'] as $promotionKey => $promotion) {
                    $promotionOrder = $promotion['order'];
                    if ($promotionOrder !== null && in_array($promotionOrder, $promotionOrders, false)) {
                        abort(422, "Order must be unique for item.[{$itemKey}].promotion.[{$promotionKey}]");
                    } else {
                        $promotionOrders[] = $promotionOrder;
                    }
                }
            }
            // sanitize link type
            if ($item['type'] === NavigationBarSetting::TYPES['LINK']) {
                $item['title']              = null;
                $item['pages']              = [];
                $item['promotions']         = [];
                $item['related_article_id'] = null;
                $item['ads_id']             = null;
            }
        }
        // bind navigation bar setting
        $setting = NavigationBarSetting::find(1) ?? new NavigationBarSetting();
        $setting->fill($data);
        // factory navigation bars
        $navigationBar = $this->navigationBarFactory->fromSetting($setting);
        // clear old navigation bars, save and save the setting
        $existingBar = NavigationBar::find(1);
        if ($existingBar) {
            $existingBar->delete();
        }
        $navigationBar->save();
        $setting->save();
        // hide ID from the response
        unset($setting->toArray()['id']);
        return response()->json($setting);
    }
}
