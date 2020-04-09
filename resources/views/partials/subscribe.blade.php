<section class="marketing-area gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="marekting-inner">
                    <h2 class="title">Get More Update  News</h2>
                    <div class="subscribe-form-wapper">
                        <form action="{{route('subscribe')}}" method="post" class="subscribe-form">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email"  class="form-control" placeholder="Enter your email...">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Subscribe now">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
