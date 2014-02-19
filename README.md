# News4ward Newsletter

Quickly send a Contao newsletter filled with variables comming from a News4ward article.

## Usage

1. Create a newsletter using the Contao module
2. Select this newsletter in the News4ward archive
3. Click on the newsletter icon within the article listing

## Newsletter InsertTags

You can use every database field from the news4ward_article to fill the newsletter using the `{{news4ward_newsletter::field}}` insert tag.

Reasonable fields:

* title
* subheadline
* author
* description
* teaser
* teaserImage
* teaserImageCaption
* url

## Sample Newsletter

```html
<p>New News4ard Blog Article from {{news4ward_newsletter::author}}</p>
<h1>{{news4ward_newsletter::title}}</h1>
<h2>{{news4ward_newsletter::subheadline}}</h2>
<p>&nbsp;</p>
<p>You can view it here: {{news4ward_newsletter::url}}</p>
```


License: http://www.gnu.org/licenses/lgpl-3.0.html LGPL <br>
Author: [4ward.media](http://www.4wardmedia.de)