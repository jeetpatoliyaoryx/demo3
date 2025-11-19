@extends('layouts.app')
@section('style')
<style type="text/css">
   .terms-of-use-wrap {
            display: flex !important;
            gap: 130px !important;
            padding: 40px !important;
        }

        .terms-of-use-wrap>.left {
            width: 360px !important;
            flex-shrink: 0 !important;
            height: max-content !important;
            top: 82px !important;
            border-left: 1px solid var(--line) !important;
            position: sticky !important;
            background-color: white;
            z-index: 99 !important;
            
        }

        .terms-of-use-wrap>.left h6 {
            position: relative !important;
            padding: 10px 0 10px 16px !important;
            cursor: pointer !important;
        }

        .terms-of-use-wrap>.left h6:before {
            position: absolute !important;
            content: "" !important;
            top: 0 !important;
            left: -1px !important;
            width: 2px !important;
            height: 0 !important;
            background-color: var(--main) !important;
            transition: all .3s ease !important;
        }

        .terms-of-use-wrap>.left h6.active:before {
            height: 100% !important;
        }

        .terms-of-use-wrap>.right {
            flex-grow: 1 !important;
        }

        .terms-of-use-wrap>.right .heading {
            margin-bottom: 40px !important;
        }

        .terms-of-use-wrap>.right .terms-of-use-item:not(:last-child) {
            margin-bottom: 32px !important;
        }

        .terms-of-use-wrap>.right .terms-of-use-item .terms-of-use-title {
            margin-bottom: 12px !important;
        }

        .terms-of-use-wrap>.right .terms-of-use-item .terms-of-use-content {
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
        }
        @media (max-width: 991px) {
    .terms-of-use-wrap {
        flex-direction: column !important;
        gap: 30px !important;
        padding: 20px !important;
    }

    .terms-of-use-wrap > .left {
        width: 100% !important;
        position: relative !important;
        top: 0 !important;
        border-left: none !important;
        border-bottom: none !important;
        display: flex !important;
        flex-direction: column;
        /* flex-wrap: wrap !important; */
        gap: 12px !important;
        justify-content: flex-start !important;
    }

    .terms-of-use-wrap > .left h6 {
        padding: 8px 12px !important;
        border-radius: 6px !important;
        border: 1px solid var(--line) !important;
        background-color: var(--white) !important;
        flex: 1 1 calc(50% - 12px) !important; /* 2 per row on mobile */
        text-align: center !important;
    }

    .terms-of-use-wrap > .left h6.active {
        background-color: var(--main) !important;
        color: #fff !important;
        border-color: var(--main) !important;
    }

    .terms-of-use-wrap > .left h6::before {
        display: none !important; /* hide the left line indicator on mobile */
    }

    .terms-of-use-wrap > .right {
        flex-grow: 1 !important;
        width: 100% !important;
    }
}

</style>
@endsection 
@section('content')


        <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}})">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Terms of use</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="{{ url('/') }}">Home</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="#">Our Policy</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Terms of use</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




       <section class="flat-spacing">
            <div class="container">
                <div class="terms-of-use-wrap">
                    <div class="left sticky-top">
                        @foreach($getRecord as $key => $value)
                                    <h6 class="btn-scroll-target {{ $key == 0 ? 'active' : '' }}">{{ $value->title }}</h6>
                                @endforeach
             
                    </div>
                    <div class="right">
                        <h4 class="heading">Terms & Conditions</h4>
                   
                         @foreach($getRecord as $value)
                        <div class="terms-of-use-item item-scroll-target" id="terms">
                            <h5 class="terms-of-use-title" style="word-break: break-all;">{{ $value->title }}</h5>
                            <div class="terms-of-use-content" style="word-break: break-all;">
                                {{ $value->description }}
                            </div>
                        </div>
                         @endforeach

                    </div>
                </div>
            </div>
        </section>




@endsection
@section('script')


<script>
document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('.btn-scroll-target');
    const sections = document.querySelectorAll('.item-scroll-target');
    const offset = 120; // Adjust for your sticky header height

    function scrollToSection(index) {
        const target = sections[index];
        if (!target) return; // Prevent error if counts differ

        const elementTop = target.getBoundingClientRect().top + window.scrollY;
        let topPos = elementTop - offset;

        // Prevent overscroll on last section
        const maxScroll = document.body.scrollHeight - window.innerHeight;
        if (topPos > maxScroll) topPos = maxScroll;

        window.scrollTo({
            top: topPos,
            behavior: 'smooth'
        });
    }

    // Handle clicks
    navItems.forEach((item, index) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            // Update active state immediately
            navItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            scrollToSection(index);
        });
    });

    // Scroll listener to update active state
    window.addEventListener('scroll', () => {
        const scrollPos = window.scrollY + offset + 10;

        sections.forEach((section, index) => {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;

            if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                navItems.forEach(i => i.classList.remove('active'));
                if (navItems[index]) navItems[index].classList.add('active');
            }
        });
    });
});
</script>

<script type="text/javascript">

</script>
@endsection