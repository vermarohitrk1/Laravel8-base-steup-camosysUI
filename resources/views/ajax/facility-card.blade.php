@foreach($facilities as $facility)
          <div class="col-md-6 col-lg-4">
              <div class="card">
                  <img class="card-img-top" src="../../../app-assets/images/slider/04.jpg" alt="Card image cap" />
                  <div class="card-body">
                      <h4 class="card-title">{{ $facility->name}}</h4>
                      <p class="card-text">
                          Some quick example text to build on the card title and make up the bulk of the card's content.
                      </p>
                      <a href="/admin/managefacility/{{ $facility->id }}" class="btn btn-outline-primary">View <i data-feather='arrow-right'></i></a>
                  </div>
              </div>
          </div>
@endforeach