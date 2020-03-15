# covid19
Transform data from John Hopkins University Covid https://github.com/CSSEGISandData

Converts column updates to rows.

file output: Date(YMD), Country, Confirmed
Sorted by date, country.

By @sensorpro

For @observablehq visualisation: 
https://sensorpro.net/charts/covid19

excludes China.

Cronjob runs every day at 6am UTC & outputs files here:
Rest of World, excluding China:
https://cron.ventryweather.com/covid-row.csv

US-Only:
https://cron.ventryweather.com/covid-us.csv
