<x-layout>

    @include('partials.hero')
    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        <!-- Item 1 -->
        @foreach($listings as $listing)
          <x-listing-card :listing="$listing"></x-listing-card>
        @endforeach
    </div>
</x-layout>
