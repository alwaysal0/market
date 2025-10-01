@vite('resources/css/modules/reviews.css')

<div id="write-review-wrapper">
    @guest
        <div id="write-review-overlay">
            <p>To write a review, you must be logged in.</p>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
        </div>
    @endguest
    <form id="write-review-form" method="POST" action="{{ route('review', ['id' => $product->id]) }}">
        @csrf
        <p id="write-review-title">Write your own review</p>
        <div class="stars">
            <input type="radio" name="rating" id="star1" value="1">
            <label for="star1" title="Poor">★</label>
            
            <input type="radio" name="rating" id="star2" value="2">
            <label for="star2" title="Fair">★</label>
            
            <input type="radio" name="rating" id="star3" value="3">
            <label for="star3" title="Good">★</label>
            
            <input type="radio" name="rating" id="star4" value="4">
            <label for="star4" title="Very Good">★</label>
            
            <input type="radio" name="rating" id="star5" value="5">
            <label for="star5" title="Excellent">★</label>
        </div>
        <div class="write-review-input-cont">
            <textarea name="message" id="write-review-textarea" placeholder=""></textarea>
            <label for="write-review-textarea">Review</label>
        </div>
        <button type="submit">Post Review</button>
    </form>
</div>

<div id="review-cards-wrapper">
    @foreach ($reviews as $review)
        <div class="review-cards">
            <div>
                <p class="review-cards-username"><span>Username:</span> {{ $review->user?->username ?? 'Anonymous' }}</p>
                <p class="review-cards-rating"><span>Rating:</span> {{ $review->rating }}</p>
                @if($review->rating)
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            <span class="review-cards-rating-stars" style="color: #ffc107">★</span>
                        @else
                            <span class="review-cards-rating-stars" style="color: #ddd">★</span>
                        @endif
                    @endfor
                @endif
            </div>
            <p class="review-cards-message"><span>Message:</span> {{ $review->message }}</p>
            <p class="review-cards-date"><span>Created at:</span> {{ $review->created_at }}</p>
        </div>
    @endforeach
</div>
