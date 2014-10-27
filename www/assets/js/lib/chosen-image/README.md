# Chosen Image

Extends the functionaility of the Chosen plugin by Harvest to display inline images in dropdown menus

[View Example](http://djgrant.github.com/chosen-image/example.html)

### Usage

Add attribute `data-img-src` to `<option>` items with the source of your image file.

```html
<select data-placeholder="Choose a Project..." class="my-select" style="width:350px;" tabindex="2">
  <option data-img-src="chosenImage/flag-red.gif">Project A</option> 
  <option>Project B</option> 
</select>
```

Use `chosenImage()` in place of `chosen()` passing in the same properties:

```js
$(".my-select").chosenImage({
  disable_search_threshold: 10 
});
```

All properties of `chosen()` are available through `chosenImage()`

By default images are resized to 12px tall in `chosenImage.css`
  
### Dependencies

- jQuery 1.4+
- Chosen