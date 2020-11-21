How to work with the WordPress themes

The WordPress themes work on the same basic principle as our regular 
store templates - they connect to our system and get data about the web 
hosting services, which you have activated via your Reseller Control Panel.

Due to the fact that the WordPress themes are not an integral part of 
our reseller hosting system at the moment, they require a bit of 
fine-tuning in order to function properly. Here you can find all the 
necessary steps to set up a WordPress-based website.

PART 1: INSTALLING WORDPRESS AND SETTING UP YOUR WEBSITE

Download and install WordPress:

You need to have a working WordPress installation in your web hosting 
account. If you have a web hosting account with us, you can use our 
Applications Installer tool to install WordPress. If you have a web 
hosting account with another provider, you will have to check with them 
to learn how to install WordPress in your account.

Tip: As a web hosting reseller with ResellersPanel, you can get a new 
web hosting account at a discounted wholesale price.

Note: You can use domains like "my-hosting-store.com" or subdomains like 
"hosting.my-domain.com" for your WordPress installation.

Download the ResellersPanel plugin and theme:

Once you have WordPress installed, download our ResellersPanel plugin ? 
it will connect your store with our system. Once you have the .zip 
archive, upload it to the /plugins/ folder of your WordPress 
installation and extract it.

Do the same with the theme you have chosen - upload it to the /themes/ 
folder and extract the archive.

Note: Our themes and our plugin can be downloaded only from our Reseller 
Control Panel. You will need a free account with ResellersPanel in order 
to use them.

Note: With our Control Panel, you can easily extract an uploaded .zip 
archive. If your WordPress installation is hosted with another provider, 
which does not allow extraction of .zip archives, you will have to 
extract the files on your local computer and then upload them.

Once the plugin and the theme are extracted, you can activate them both 
from the WordPress admin area. If you don't see them in the respective 
section of the WordPress admin area, check if they are uploaded at the 
right place. If you are still having problems, contact our support team.

Activate the Reseller API:

Go to the Reseller Control Panel and navigate to the API Settings menu, 
located under Reseller Tools. From there, enable Simple Mode and enter 
the URL of your website, where WordPress is installed. For example - 
http://my-hosting-store.com/. If WordPress is installed in the 
/wordpress/ folder, enter http://my-hosting-store.com/wordpress/ in the 
form.


Set up the ResellersPanel plugin:

Go to the WordPress admin area and navigate to the ResellersPanel menu 
on the left side. Once there, enter the name of the reseller store you 
want to use and the password for your reseller account. The plugin will 
then attempt to connect with our system - if the connection is 
successful, you will see a list of the web hosting services you are 
offering listed on the page.


You can now check your WordPress site - it will feature the default 
index page we have selected and a default menu. From this point on, you 
can start customizing your website.

PART 2: CUSTOMIZING YOUR WEBSITE

Our plugin inserts several pages into your WordPress installation. You 
can create your website by combining these pages. In order to use a 
page, all you have to do is add it to a menu. Unused pages will be 
available for you to use later on.

We offer several different home page layouts, as well as different 
layouts for most of the other pages. Once you have selected the pages 
you want to use for your website, you can also modify them to your 
liking - change the text, select a "best plan", add custom HTML, etc.

By default, when you install the plugin, you will receive ready-made top 
and footer menus. You can keep on using the default menus, or build new 
ones.

Setting the index page:

To set a default index page, go to the Settings menu and choose Reading. 
In the "Front page displays" section, select "A static page (select 
below)" and choose the front page from the drop-down menu. You can 
choose between any one of the pages available to you, but we have built 
several dedicated index pages, titled Home 1, Home 2, etc. You don't 
have to specify a "Posts page:".

Building a custom menu:

To change the menu items, go to the Appearance section and click on the 
Menus option. Create a new menu and put a name on it. Then, add the 
pages you want to see in the menu - all the pages are available in a box 
on the left side of the screen. Once you add them, you can arrange them 
in the way that you want and also create sub-menus.

We support 2 types of menus - top navigation and footer menus. Once you 
create a menu, you can assign it to any position via the drop-down 
selectors in the upper left corner of the page.

Starting a blog:

Since this is WordPress, you can start your own blog. To do so, create a 
sample blog post (you can also use the existing sample post by the 
WordPress team) and add a new category. You can then link this category 
to an existing menu via the menu builder tool. The Home 1 and Home 2 
layouts also support blog posts on the index page.

Customizing the pages:

You are free to modify any of the pages in the WordPress installation to 
your liking:

- Changing the text - you are free to modify the text on the pages - add 
new sentences, delete existing content, translate the page to another 
language, etc.

- Adding custom elements - if you have HTML skills, you can add new 
elements to each page.

- Meta title, meta description, meta keywords - each page comes with 
predefined meta content. You are free to change it whenever you like.

- Choosing a "best plan" for the product pages - on each product page as 
well as on the home page, you can choose a plan to be highlighted from 
the rest - this will be your top offer. To set a "best plan", locate the 
'best=""' string on the page, and fill in the plan ID between the 
quotes. It should look like this: best="44".

You can check the plan IDs on the right side of the page.

- Plan arrangement - all product pages will feature a plan comparison 
table. To change the plans? arrangement, go to the "My Offers" section 
of the Reseller Control Panel and modify the plan order. Plans that are 
"on top" will be shown first in the plan comparison table. We will show 
only web hosting offers that are marked as Active and Offered. Plans 
marked only as Active will appear only on the Order form and will not be 
shown on the product pages.

- TLD arrangement - the situation is similar with the arrangement of the 
web hosting services on the product pages - TLDs will be displayed 
depending on their position in the Domain Offers section of the Reseller 
Control Panel. If you activate or deactivate a TLD from the Reseller 
Control Panel, it will appear or disappear from your website.

- The Special Page option - for each page, you can enable the Special 
Page option. This option will add a special header area, which will be 
filled with text and an image for the selected product group. You will 
be able to change the text at any time.

Note: Do not remove the elements in the brackets: []. These elements are 
used by our plugin to connect with our reseller hosting system and are 
responsible for displaying the web hosting services that you offer on 
the page.

Note: We have disabled the Visual editor option in WordPress - all page 
or blog edits will have to be made with the HTML editor.

Home page:

When you choose your your Index page, you can also choose which plans 
will be promoted. All our Index pages feature a banner at the top, where 
you can showcase one plan - a shared hosting plan, or a VPS, dedicated 
or semi-dedicated hosting package. To choose a plan, look for the

[home_banner variant="1" plan="1"]

string. There, simply change the value in plan="1" with the ID of the 
plan you want to showcase.

If your Home page features a plan table or plan boxes, you can also set 
the plans which are shown there. To do this, look for the

home_plan_boxes variant="1" plans="1,2,44"

string. There, again, change the value in plans="1,2,44" and enter the 
IDs of the plans you wish to show, in the order you wish to show them. 
To set a best plan, again, look for best="2" and change the value with 
the ID of the plan you wish to promote.

Order buttons:

You can quickly change the text of the order button on each page. To do 
so, look for the

button='<button type="submit" class="rpwp-button colorize"><span 
class="gloss"></span>order now</button>

string. There, change the text "order now" with any text you want. Enter 
it in lowercase, our system will capitalize it for you.

Article pages:

These pages are there for SEO purposes - they feature quality content, 
written by our copywriters to help you rank higher in search engines. On 
each page, depending on the chosen page layout, you can promote your web 
hosting services. By default, we show the hosting service the article is 
written about ? if the article is about shared hosting, we will show a 
table with the shared hosting plans that you offer. If you wish to 
highlight a plan, simply enter its ID in the designated field - it's 
just like setting up a "best plan" offer.

Page layouts:

Most pages come with several different layouts. You can build a custom 
menu or choose the default menu that we provide.

To do so, click on the Defaults menu for the ResellersPanel plugin. From 
there, you will be able to specify a desired layout for pages that offer 
multiple versions - product pages, data center pages, etc. Changes will 
be reflected automatically on your website - aside from the links in the 
menu, all text links will also point to the chosen layout.

How to change a page URL/permalink

When you install the plugin, we will overwrite the default WordPress URL 
structure with a more SEO-friendly one. By default, WordPress URLs look 
like this:

http://website.com/?p=123

We change them to look like this:

http://website.com/page-name

To modify the overall URL structure, you can go to the Settings -> 
Permalinks section of the WordPress admin area and choose a different 
URL structure. To change the permalink of a single page, you can go to 
the ResellersPanel -> Pages section, find the page that you want to 
modify, click on the Edit button and change the URL. Don't forget to hit 
Update to save your changes.

How to change theme colors

Once you have installed and activated one of our WordPress themes, go to 
the Appearance -> Theme Options section of the WordPress admin area. 
From there, you will be able to select one of the 4 color options for 
each of our themes.

How to change the name/title of your WordPress blog

To change the title of the blog, go to the Settings -> General section 
of the WordPress admin area and change the Site Title with anything you 
like. Be careful with long store titles as they might break the theme 
design.

How to change your logo

Once you have installed and activated one of our WordPress themes, go to 
the Appearance -> Theme Options section of the WordPress admin area. 
From there, you will be able to upload a custom logo for your website. 
The recommended logo size is: 65x65px.

How to set up Google Analytics

Once you have installed and activated one of our WordPress themes, go to 
the Appearance -> Theme Options section of the WordPress admin area. In 
the Analytics/Tracking Code field, paste the code that Google has 
provided you with.

If, at any point, you run into problems while downloading or setting up 
our WordPress themes or plugin, do not hesitate to contact our support 
team for assistance.