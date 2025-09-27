<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $code
 * @property string $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailVerification whereUpdatedAt($value)
 */
	class EmailVerification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $filter_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter whereFilterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Filter whereUserId($value)
 */
	class Filter extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image_url
 * @property string $image_public_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImagePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUserId($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $confirmed
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $confirmation_link
 * @property string $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation whereConfirmationLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserConfirmation whereUpdatedAt($value)
 */
	class UserConfirmation extends \Eloquent {}
}

