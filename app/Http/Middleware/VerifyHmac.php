<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyHmac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       // if(! app()->environment('local')){
            $rawBody=file_get_contents('php://input');
            if($this->verifyShopifyHmac($rawBody,env('API_SECRET_KEY_SHOPIFY_APP'),$request->header('X-Shopify-Hmac-SHA256'))){
              
                return $next($request);
            }else{
                Log::info('middle-verify-webhook');
                Log::info($rawBody);


                return response()->json([
                    'error'=>'không đủ quyền hạn',
                    'status_code'=>422
                ]);

            }
       // }
    }
    
    private function verifyShopifyHmac($body, $secret, $hmac)
    {
        return hash_equals(base64_encode(hash_hmac('sha256', $body, $secret, true)), $hmac);
    }
    
}
