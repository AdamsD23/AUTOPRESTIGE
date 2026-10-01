<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'password',
        'telephone',
        'adresse',
        'ville',
        'role',
        'date_naissance',
        'photo_profil',
        'derniere_connexion',
        'preferences'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'derniere_connexion' => 'datetime',
        'preferences' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'initials'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }

    /**
     * Get the user's initials.
     *
     * @return string
     */
    public function getInitialsAttribute()
    {
        return mb_substr($this->prenom, 0, 1) . mb_substr($this->nom, 0, 1);
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a client.
     *
     * @return bool
     */
    public function isClient()
    {
        return $this->role === 'client' || $this->role === null;
    }

    /**
     * Get the user's reservations.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get the user's active cart.
     */
    public function cart()
    {
        return $this->hasOne(Cart::class)->where('is_active', true);
    }

    /**
     * Get all user's carts.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the user's contact messages.
     */
    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }

    /**
     * Get the user's favorite vehicles.
     */
    public function favoris()
    {
        return $this->belongsToMany(Vehicule::class, 'favoris')
            ->withTimestamps()
            ->withPivot(['created_at']);
    }

    /**
     * Get the user's reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if the user has favorited a vehicle.
     *
     * @param  int  $vehiculeId
     * @return bool
     */
    public function hasFavori($vehiculeId)
    {
        return $this->favoris()->where('vehicule_id', $vehiculeId)->exists();
    }

    /**
     * Get the user's full address.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return trim(implode(', ', array_filter([$this->adresse, $this->ville])));
    }

    /**
     * Scope a query to only include admin users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope a query to only include regular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClients($query)
    {
        return $query->where('role', 'client')->orWhereNull('role');
    }

    /**
     * Get the user's active reservations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activeReservations()
    {
        return $this->reservations()
            ->where('date_fin', '>=', now())
            ->where('statut', 'confirmee')
            ->orderBy('date_debut');
    }

    /**
     * Get the user's past reservations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pastReservations()
    {
        return $this->reservations()
            ->where('date_fin', '<', now())
            ->orWhere('statut', 'terminee')
            ->orderBy('date_fin', 'desc');
    }

    /**
     * Get the user's upcoming reservations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upcomingReservations()
    {
        return $this->reservations()
            ->where('date_debut', '>', now())
            ->where('statut', 'confirmee')
            ->orderBy('date_debut');
    }

    /**
     * Get the user's pending reservations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendingReservations()
    {
        return $this->reservations()
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get the user's payment methods.
     */
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    /**
     * Get the user's default payment method.
     */
    public function defaultPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::class)->where('is_default', true);
    }

    /**
     * Get the user's notifications.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class)->latest();
    }

    /**
     * Get the user's unread notifications.
     */
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    /**
     * Get the user's profile photo URL.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->photo_profil 
            ? asset('storage/' . $this->photo_profil)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Update the user's last login time.
     *
     * @return void
     */
    public function updateLastLogin()
    {
        $this->update(['derniere_connexion' => now()]);
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->preferences['locale'] ?? config('app.locale');
    }

    /**
     * Check if the user has a specific permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if ($this->isAdmin()) {
            return true;
        }

        return in_array($permission, $this->permissions ?? []);
    }

    /**
     * Get the user's full name with title.
     *
     * @return string
     */
    public function getFormalNameAttribute()
    {
        return "M. {$this->prenom} {$this->nom}";
    }
}
