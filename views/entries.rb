require 'rubygems'
require 'couchrest'

couch = CouchRest.new('http://127.0.0.1:5984')
db = couch.database('hn')

def all()
  {
    :map => "function(doc) {
      emit(doc.title, doc);
    }"
  }
end

def latest()
  {
    :map => "function(doc) {
      emit(Date.parse(doc.updated), doc);
    }"
  }
end

db.delete_doc db.get('_design/entries') rescue nil

db.save_doc({
  "_id"  => "_design/entries",
  :views => { :all => all, :latest => latest() }
})
