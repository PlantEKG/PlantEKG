#!/usr/bin/env ruby
require 'rubygems'
require "watir-webdriver"
browser = Watir::Browser.new :ff

# To run Scripts, make sure ruby is 

browser.goto "http://ec2-107-20-111-184.compute-1.amazonaws.com/PlantEKG/index.php"

if(browser.title == "PlantEKG")
	puts "Title is as expected!"
else
	puts "Title failed to load properly"
end


# Checks for page redirection
if (browser.div(:class => 'container').h3.text== "My Plant Collection")
	puts "Page loads!"
else
	puts "Page failed to load"
end

# Checks that search for a known room generates the correct description page
browser.text_field(:name => "plant_name").set "Aloe"
puts "Typing in Aloe into the search bar"

browser.form(:action => 'searchplant.php').submit

if (browser.div(:class => 'container').h3.text== "Aloe")
	puts "Aloe description loads!"
else
	puts "Aloe description FAILED to load"
end

browser.close