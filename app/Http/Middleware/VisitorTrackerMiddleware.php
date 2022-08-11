<?php
    
    namespace App\Http\Middleware;
    
    use App\Models\VisitorTracker;
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;

    class VisitorTrackerMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next)
        {
            return $next($request);
        }
        
        public function terminate(Request $request, $response)
        {
            VisitorTracker::create($this->getTrackingData($request, $response));
            
            return $response;
        }
        
        protected function getTrackingData(Request $request, $response): array
        {
            return [
                'request_uri' => $request->getRequestUri(),
                'http_referer' => $request->server->get('HTTP_REFERER'),
                'status_code' => $response->status(),
                'session_id' => $request->getSession()->getId(),
                'search_term' => $request->get('searchTerm'),
                'remote_addr' => $request->server->get('REMOTE_ADDR'),
                'http_user_agent' => $request->server->get('HTTP_USER_AGENT'),
                'is_bot' => $this->is_bot($request->server->get('HTTP_USER_AGENT')),
                'request_method' => $request->server->get('REQUEST_METHOD'),
                'query_string' => $request->server->get('QUERY_STRING'),
            ];
        }
    
        protected function is_bot($agent)
        {
            return Str::contains(Str::lower($agent), ['robot', 'bot', 'crawler', 'analytics']);
        }
    }
