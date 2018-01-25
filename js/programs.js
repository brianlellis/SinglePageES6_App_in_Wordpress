import "../css/program-styles.css";

/** Class for filtering programs via history state in the browser */
class Programs_App {
  /**
   * @property {string}  this.uri               - Stores current window.location.href
   * @property {object}  this.programs          - Caches the element for future use within the app
   * @property {object}  this.filterBoxes       - Caches the element for future use within the app
   * @property {object}  this.filterSelect      - Caches the element for future use within the app
   * @property {object}  this.errorModal        - Caches the element for future use within the app
   * @property {object}  this.autoEle           - Caches the element for future use within the app
   * @property {string}  this.errorMsg          - Stores current error msg based on user behavior
   */
  constructor() {
    this.paramEval();
    this.programs     = document.querySelectorAll('.program.card');
    this.filterBoxes  = document.querySelectorAll('.h300 .shown');
    this.filterSelect = document.querySelectorAll('.select .option');
    this.filterResets = document.querySelectorAll('#filter-select-resets button');
    this.autoEle      = this.errorModal = this.errorMsg = null;
    this.autoList     = [];
  }

  /**
   * @function initialize
   * Initializes the Programs_App and its methods
   */
  initialize() {
    this.historyBuilder();
    this.filterBoxOpenClose();
    this.filterParamSelect();
    this.filterSelectRemove();
    this.autoCompCreate();
    this.errorModule();
  }

  /**
   * @function historyBuilder
   * Establishes initial history and navigation listener in the browser to allow back and forward functionality
   */
  historyBuilder() {
    history.replaceState( { id: 'programs', currentState: this.uri } , document.title , '' );
    window.addEventListener('popstate', function (event) { this.domManip(); }, false);
  }

  /**
   * @function paramEval
   * Evaluates the browser current URI and formats it
   * @return {string} The correct URI for app functionality.
   */
  paramEval() {
    let curUri = window.location.href,
        uriEval = curUri.match(/\?\b[a-z]+(.*)/g);
    
    uriEval !== null ? this.uri = uriEval[0] : this.uri = curUri;
  }

  /**
   * @function domManip
   * Add/Remove classes on .program.card ele based on filter selection
   */
  domManip() {
    this.paramEval();

    if (history.state && history.state.id === 'programs') {
      this.programs.forEach(v=>{
        let data = v.dataset,
            nodisplay = false;

        // CHECK SEARCH PARAM AGAINST DATA PROPS IN PROGRAM CARDS
        for (let prop in data) {
          if ( this.uri.indexOf(prop) > 0 && this.uri.indexOf( data[prop] ) < 0 ) nodisplay = true;
        }
        nodisplay ? v.classList.add('no-display') : v.classList.remove('no-display');
      });
    }
  }

  /**
   * @function filterBoxOpenClose
   * Event listener for opening/closing the program filter boxes
   *
   */
  filterBoxOpenClose() {
    this.filterBoxes.forEach(v=>{
      v.addEventListener('click', event=>{
        document.getElementById('filter-wrapper').classList.toggle('filters-open');
        this.filterBoxes.forEach(ele=>{ ele.parentNode.classList.toggle('collapsed') })
      });
    });
  }

  /**
   * @function filterParamSelect
   * Event listener filtering programs based on selection
   */
  filterParamSelect() {
    if (document.querySelectorAll('.filter-reset__trigger').length) document.getElementById('filter-wrapper').classList.add('filtered');

    this.filterSelect.forEach(v=>{
      v.addEventListener('click', e=>{
        e.stopPropagation();

        let data = v.dataset,
            searchParam = Object.keys(data)[0]+"="+data[Object.keys(data)], 
            searchState;

        if ( this.uri.indexOf( `=${data[Object.keys(data)]}` ) < 0 ) {
          this.uri.indexOf('?') < 0 ? searchParam = "?"+searchParam : searchParam = "&"+searchParam;

          searchState = (this.uri+searchParam).match(/\?\b[a-z]+(.*)/g);

          history.pushState( { id: 'programs', currentState: searchState } , document.title , this.uri+searchParam );
          document.getElementById('filter-wrapper').classList.add('filtered');

          //FILTER RESET PROPAGATION
          this.filterResets.forEach(r=>{
            let click = e.target.parentNode.dataset,
                rCheck = r.dataset;

            if (rCheck[Object.keys(rCheck)] === click[Object.keys(click)]) r.classList.add('active');
          })

          this.domManip();
        } else {
          this.errorModuleOpen(Object.keys(data)[0]);
        }
      });
    });
  }

  /**
   * @function filterSelectRemove
   * Remove selected filters
   */
  filterSelectRemove() {
    this.filterResets.forEach(v=>{
      v.addEventListener('click', e=>{
        e.stopPropagation();

        let searchState = this.uri.match(/\?\b[a-z]+(.*)/g),
            data = v.dataset,
            searchParam = Object.keys(data)[0]+"="+data[Object.keys(data)],
            termIndex = searchState[0].indexOf(searchParam),
            opRemove = searchState[0].slice(termIndex - 1, termIndex);

            this.uri = window.location.href.replace(opRemove+searchParam, "");
            this.uri = this.uri.replace('programs/&','programs/?');

        history.pushState( { id: 'programs', currentState: searchState } , document.title , this.uri);
        v.classList.remove('active');

        this.domManip();
      });
    });
  }

  /**
   * @function autoCompCreate
   * Creates the autoComp input box
   */
  autoCompCreate() {
    const autoBox   = document.createElement("input"),
          childRef  = document.querySelectorAll('.h300 .select .option')[0],
          parentRef = childRef.parentNode;

    autoBox.id = 'filter-auto-comp';
    autoBox.placeholder = 'Search';
    parentRef.insertBefore(autoBox, childRef);

    this.autoEle = document.getElementById('filter-auto-comp');
    this.autoEle.addEventListener('click', e=>{ e.stopPropagation(); });
    this.autoCompList();
  }

  /**
   * @function autoCompList
   * Creates a list for autoComp to ref during event
   */
  autoCompList() {
    this.filterSelect.forEach(v=>{
      if (v.dataset.destination) this.autoList.push({ id: v.dataset.destination, val: v.innerText});
    });
    this.autoComplete();
  }

  /**
   * @function autocomplete
   * Event listener for autoComplete to manipulate filter select DOM
   */
  autoComplete() {
    this.autoEle.onkeyup = e=>{
      let input_val = e.target.value; // updates the variable on each ocurrence

      if (input_val.length > 0) {
        this.filterSelect.forEach(v=> {
          if (v.dataset.destination) v.innerText.indexOf(input_val) < 0 ? v.classList.add('no-display') : v.classList.remove('no-display');
        });
      } else {
        this.filterSelect.forEach(v=> {
          v.classList.remove('no-display');
        });
      }
    }
  }

  /**
   * @function errorModule
   */
  errorModule() {
    const modal = document.createElement("div");

    modal.id = 'programs-error-modal';
    modal.classList.add('no-display');
    modal.innerHTML = `
      <h1 id="error-modal-msg">I am an error modal</h2>
      <h2 id="error-modal-close">CLOSE ME</h2>
    `;

    document.body.appendChild(modal);
    this.errorModal = document.getElementById('programs-error-modal');
    this.errorModal.style = "visibility: hidden";
    this.errorMsg = document.getElementById('error-modal-msg');

    // CLICK HANDLE EVENT LISTENER
    this.errorModal.addEventListener('click', e=>{
      this.errorModal.classList.add('no-display');
      setTimeout(()=> this.errorModal.style = "visibility: hidden", 500);
      document.body.classList.remove('no-scroll');
    });
  }

  /**
   * @function errorModuleOpen
   * Opens the error modal upon event firing
   * @param {string} msg - Message to populate the module upon event firing
   */
  errorModuleOpen(msg) {
    document.body.classList.add('no-scroll');
    this.errorMsg.innerText = `You cannot filter the same ${msg} twice`;
    this.errorModal.style = "";
    this.errorModal.classList.remove('no-display');

  }
}

const ProgramsApp = new Programs_App();
if ( document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll) ) ProgramsApp.initialize();
else document.addEventListener("DOMContentLoaded", ProgramsApp.initialize() );
