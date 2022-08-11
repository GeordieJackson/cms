<?php
    
    namespace App\Models\Users;
    
    use App\Models\Acl\ExtractIds;
    use App\Models\Posts\Post;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Fortify\TwoFactorAuthenticatable;
    use Laravel\Jetstream\HasProfilePhoto;
    use Laravel\Jetstream\HasTeams;
    use Laravel\Sanctum\HasApiTokens;
    
    class User extends Authenticatable
    {
        use HasApiTokens;
        use HasFactory;
        use HasProfilePhoto;
        use HasTeams;
        use Notifiable;
        use TwoFactorAuthenticatable;
        use ExtractIds;
        use Relationships;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'forename', 'surname', 'slug', 'email', 'password',
        ];
        
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password',
            'remember_token',
            'two_factor_recovery_codes',
            'two_factor_secret',
        ];
        
        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        
        /**
         * The accessors to append to the model's array form.
         *
         * @var array
         */
        protected $appends = [
            'profile_photo_url', 'name',
        ];
        
        public function getNameAttribute(): string
        {
            return $this->attributes['forename']." ".$this->attributes['surname'];
        }
        
        public function posts()
        {
            return $this->hasMany(Post::class, 'owner_id');
        }
        
        public function scopeIndex($query)
        {
            return $query->select('id', 'forename', 'slug', 'surname', 'email', 'email_verified_at');
        }
        
        public function scopeById($query, int $id)
        {
            return $query->select('id', 'forename', 'surname', 'email', 'email_verified_at')->whereId($id);
        }
        
        public function scopePublishedAuthors($query, $paginate = 10)
        {
            return $query->withCount([
                'posts' => function ($posts) {
                    $posts->published()->where('type', '!=', Post::PAGE);
                },
            ])->orderBy('slug')->paginate($paginate)
                ->reject(fn($user) => $user->posts_count == 0);
        }
        
        public function scopeAuthorBySlug($query, $slug)
        {
            return $query->whereSlug($slug)->firstOrFail();
        }
    
        public function scopePublishedAuthorBySlug($query, $slug)
        {
            return $query->whereSlug($slug)->whereHas('posts', function($query) {
                $query->published();
            } )->firstOrFail();
        }
    }
