<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        {!! DNS1D::getBarcodeHTML($getState(), 'C39',2,33)  !!}
    </div>
</x-dynamic-component>
