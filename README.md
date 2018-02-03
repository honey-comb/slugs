# slugs
Slugs manager for HoneyComb CMS

## Usage

`generateHCSlug(string $path, string $string, string $separator = '-')`

It is a helper function, which requires few parameters:

`$path` - Under which domain the slug will be generated.

`$string` - Source from which text the slug will be generated.

`$separator` - You can specify a custom separator

## Examples

Let's say we have 2 services `House` and `Flat`. Each of them will have a record with at title `One`. And both of them will require a slug.

`$houseSlug = generateHCSlug('house', 'One'); // output: one`

`$flatSlug = generateHCSlug('flat', 'One'); // output: one`

Only when we will call it with the same name few times, then it will kick in.

`$flatSlug = generateHCSlug('flat', 'One'); // output: one`

`$flatSlug = generateHCSlug('flat', 'One'); // output: one-1`

`$flatSlug = generateHCSlug('flat', 'One'); // output: one-2`
