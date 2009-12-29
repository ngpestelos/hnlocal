#!/usr/bin/ruby

require 'rubygems'
require 'rfeedparser'
require 'couchrest'
require 'time'

pf = FeedParser.parse('http://news.ycombinator.com/rss')

docs = pf.entries.collect do |e|
  {
    'title'   => e.title,
    'updated' => Time.now.rfc2822,
    '_id'     => e.link,
    'summary' => e.has_key?('summary') ? e.summary : e.description,
    'couchrest-type' => 'Entry'
  }
end

couch = CouchRest.new('http://127.0.0.1:5984')
db = couch.database('hn')
docs.each { |d| db.save_doc(d) rescue puts "Unable to save entry " + d['_id'] }
