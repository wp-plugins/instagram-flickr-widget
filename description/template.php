<p>
	The templating option provides several tags for you to use to control where variables are inserted into your HTML markup.
</p>
<p>Available keywors are:</p>

<h3>Instagram</h3>
<ul>
	<li>{{link}} - URL to view the image on Instagram's website.</li>
	<li>{{image}} - URL of the image source. The size is:  
		<ul>
			<li>{{image_sm}}: Small</li>
			<li>{{image_m}}: Medium</li>
			<li>{{image_b}}: Big</li>
		</ul>
	</li>
	<li>{{id}} - Unique ID of the image. Useful if you want to use iPhone hooks to open the images directly in the Instagram app.</li>
	<li>{{caption}} - Image's caption text. Defaults to empty string if there isn't one.</li>
	<li>{{likes}} - Number of likes the image has.</li>
	<li>{{comments}} - Number of comments the image has.</li>
	<li>{{location}} - Name of the location associated with the image. Defaults to empty string if there isn't one.</li>
	<li>{{model}} - Full JSON object of the image. If you want to get a property of the image that isn't listed above you access it using dot-notation. (ex: {{model.filter}} would get the filter used.)</li>
	<li>
		resolution (string) - Size of the images to get. Available options are:
		thumbnail (default) - 150x150
		low_resolution - 306x306
		standard_resolution - 612x612
	</li>
</ul>

<h4>Flickr</h4>
<ul>
	<li>{{image}} - URL of the image source. The size is:  
		<ul>
			<li>{{image_sm}}: Small</li>
			<li>{{image_m}}: Medium</li>
			<li>{{image_b}}: Big</li>
		</ul>
	</li>
	<li>{{title}} - The title of image</li>
	<li>{{description}}</li>
	<li>{{author}}</li>
	<li>{{link}}</li>
</ul>