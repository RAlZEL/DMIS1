# Inventory Management Homepage - Button Function Testing Checklist

## Testing Guide for All Buttons

### Before Testing
- [ ] Clear browser cache (Ctrl+Shift+Delete)
- [ ] Open DevTools Console (F12) to check for errors
- [ ] Ensure database has at least 1-2 properties

---

## 1. Add Property Button (Green Button with Plus Icon)
**Location**: Top right of header  
**Expected Behavior**: 
- [ ] Button appears with green background and white text
- [ ] Plus icon displays correctly
- [ ] Clicking shows "Add a new property" tooltip on hover
- [ ] Creates a modal popup for adding new property
- [ ] Modal has all required fields (article, description, property no, date, value, etc.)
- [ ] Can close modal with X button or backdrop click
- [ ] Form validates before submission

**Visual Polish**:
- [ ] Button has smooth hover effect (background change, slight lift)
- [ ] Icon spins while processing
- [ ] Loading state is visible

---

## 2. Reset Page Button (Outline Secondary Button with Rotate Icon)
**Location**: Top right of header, next to Add Property  
**Expected Behavior**:
- [ ] Button appears with outline style and gray color
- [ ] Rotate-left icon displays correctly
- [ ] Clicking shows "Reset filters and pagination" tooltip on hover
- [ ] Clears all filters immediately
- [ ] Returns to page 1 of results
- [ ] Updates stats cards (shows all items count)
- [ ] Disables button briefly during processing

**Visual Polish**:
- [ ] Button has outline style (not filled)
- [ ] Hover effect shows subtle background change
- [ ] Opacity changes during loading state
- [ ] Smooth transition when filters clear

---

## 3. Filters Button (Primary Blue Button with Filter Icon)
**Location**: Top right of header, rightmost button  
**Expected Behavior**:
- [ ] Button appears with blue (primary) background
- [ ] Filter icon displays correctly
- [ ] Clicking shows "Apply filters to properties" tooltip on hover
- [ ] Opens filter modal with multiple filter options (date range, value range, remarks, office)
- [ ] Filter inputs are pre-populated with previously selected values
- [ ] Can apply filters and see table update
- [ ] "Filtered Items" stat card updates
- [ ] "Total Unit Value (Filtered)" updates correctly
- [ ] Can clear filters individually or reset all

**Visual Polish**:
- [ ] Button has smooth hover effect
- [ ] Icon color maintains contrast
- [ ] Modal appears with proper styling
- [ ] Filter form has proper spacing and labels

---

## 4. Table Header Sorting (Click any blue underlined column header)
**Sortable Columns**:
- [ ] ARTICLE ITEM
- [ ] DESCRIPTION
- [ ] PROPERTY NO.
- [ ] DATE ACQUIRED
- [ ] UNIT VALUE
- [ ] REMARKS

**Expected Behavior for Each**:
- [ ] Cursor changes to pointer on hover
- [ ] Column header highlights slightly on hover
- [ ] Sort arrow icon (fas-arrow-up-down) displays next to column name
- [ ] First click sorts ascending
- [ ] Second click sorts descending
- [ ] Third click can toggle back to ascending (depending on implementation)
- [ ] Table re-renders with sorted data
- [ ] Pagination resets to page 1 after sorting

**Visual Polish**:
- [ ] Sort icon animates with spin effect while processing
- [ ] Header background color changes on hover (#e9ecef)
- [ ] Column header is bold and uppercase
- [ ] Arrow icon is small (fa-xs) and slightly transparent (opacity-50)
- [ ] Text is not selectable (user-select-none)

---

## 5. Show Entries Dropdown (Top left of header)
**Location**: Top left, shows "Show [10/25/50/100] entries"  
**Expected Behavior**:
- [ ] Dropdown displays 4 options: 10, 25, 50, 100
- [ ] Default value is 10
- [ ] Selecting a value immediately changes items per page
- [ ] If on page 3 with 25 items, switching to 10 may show "Page 1 of X"
- [ ] Table updates without page reload
- [ ] Count updates in pagination footer

**Visual Polish**:
- [ ] Dropdown is small (form-select-sm) to match button sizes
- [ ] List icon (fas-list) displays before "Show" text
- [ ] Proper spacing with flexbox alignment

---

## 6. Edit Button (Per Table Row - Blue Icon)
**Location**: Last column (Actions), first icon per row  
**Expected Behavior**:
- [ ] Button appears as outline primary style
- [ ] Pen-to-square icon (fas-pen-to-square) displays correctly
- [ ] "Edit property" tooltip appears on hover
- [ ] Clicking loads the specific property data
- [ ] Modal opens showing edit form with all fields populated:
  - Article Name/ID
  - Description
  - Property No.
  - Date Acquired
  - Unit Value (formatted with currency)
  - Unit of Measurement
  - Quantity Per Card
  - Quantity Per Count
  - Remarks
  - Office
  - Accountable Officer
- [ ] Can edit any field and save changes
- [ ] Modal closes after successful update
- [ ] Table row updates with new values
- [ ] Can cancel/close modal without saving

**Visual Polish**:
- [ ] Button shows as outline (not filled) with blue text
- [ ] Hover effect fills background with blue, changes text to white
- [ ] Slight translateY(-1px) lift effect on hover
- [ ] Small box-shadow appears on hover
- [ ] Loading spinner shows while fetching data
- [ ] Button disabled during processing
- [ ] Focus automatically moves to first input in modal

---

## 7. Delete Button (Per Table Row - Red Icon)
**Location**: Last column (Actions), second icon per row  
**Expected Behavior**:
- [ ] Button appears as outline danger style
- [ ] Trash-can icon (fas-trash-can) displays correctly
- [ ] "Delete property" tooltip appears on hover
- [ ] Clicking shows delete confirmation modal
- [ ] Confirmation asks "Are you sure? Do you really want to delete this property?"
- [ ] Can cancel deletion (button closes modal without deleting)
- [ ] Can confirm deletion (property is removed from table and database)
- [ ] Table updates to remove the deleted row
- [ ] If last item on page, may go to previous page
- [ ] Success is confirmed with row disappearing

**Visual Polish**:
- [ ] Button shows as outline (not filled) with red text
- [ ] Hover effect fills background with red, changes text to white
- [ ] Slight translateY(-1px) lift effect on hover
- [ ] Small box-shadow appears on hover
- [ ] Loading spinner shows while processing
- [ ] Button disabled during processing
- [ ] Confirmation modal has proper styling with warning colors

---

## 8. Table Row Hover Effect
**Expected Behavior**:
- [ ] When mouse hovers over any table row, background changes to light gray (#f8f9fa)
- [ ] Change is smooth with transition animation (0.2s)
- [ ] Subtle box-shadow appears (inset shadow for depth)
- [ ] Text remains readable
- [ ] Row height stays consistent (56px)
- [ ] Action buttons remain visible and clickable

**Visual Polish**:
- [ ] Smooth transition effect (not jerky)
- [ ] Hover effect is subtle but noticeable
- [ ] Effect only applies to tbody rows (not headers)

---

## 9. Pagination Links (Bottom of Table)
**Location**: Footer of card, right side  
**Expected Behavior**:
- [ ] Shows "Showing X to Y of Z properties" on left
- [ ] Pagination links on right (Previous, page numbers, Next)
- [ ] Can click page numbers to navigate
- [ ] Can click "Next" to go to next page
- [ ] Can click "Previous" to go to previous page
- [ ] Current page is highlighted/active
- [ ] Disabled pages are grayed out
- [ ] Table updates without page reload

**Visual Polish**:
- [ ] Pagination background is light gray (#f8f9fa)
- [ ] Proper spacing between information and pagination controls
- [ ] Responsive design (adjusts on mobile)
- [ ] List icon (fas-list) displays before stats text
- [ ] Clean Bootstrap pagination styling

---

## 10. Status Badges (Remarks Column)
**Expected Appearance**:
- [ ] **IN GOOD CONDITION** = Green badge (bg-success)
- [ ] **SURRENDER** = Yellow badge (bg-warning) with dark text
- [ ] **DISPOSAL** / **DISPOSE** = Red badge (bg-danger)
- [ ] Default = Gray badge (bg-secondary)

**Visual Polish**:
- [ ] Badges have proper padding (px-2 py-1)
- [ ] Font weight is bold (500)
- [ ] Text is readable on all background colors
- [ ] Badges are consistently styled across all rows

---

## 11. Currency Formatting (Unit Value Column)
**Expected Behavior**:
- [ ] All unit values show "₱" symbol prefix
- [ ] Numbers are formatted with comma separators (e.g., ₱ 1,234.56)
- [ ] All values show exactly 2 decimal places
- [ ] "N/A" displays for properties without values
- [ ] Values are highlighted in green (text-success) for visibility

**Visual Polish**:
- [ ] Currency values are bold (fw-600) for emphasis
- [ ] Green text (text-success) draws attention to financial data
- [ ] Proper alignment and spacing

---

## 12. Date Formatting (Date Acquired Column)
**Expected Behavior**:
- [ ] All dates display in YYYY-MM-DD format
- [ ] Dates are wrapped in light badges for visibility
- [ ] "N/A" displays for properties without dates
- [ ] Dates are right-aligned and centered in column

**Visual Polish**:
- [ ] Badge styling with light background (bg-light) and dark text
- [ ] Consistent date format across all rows
- [ ] Badge padding for readability (px-2 py-1)

---

## 13. Empty State (No Properties Found)
**Expected Behavior When No Properties Exist**:
- [ ] Large inbox icon (fas-inbox) displays
- [ ] Message says "No properties found"
- [ ] Proper centering with vertical padding (py-4)
- [ ] Text is muted color for subtle appearance
- [ ] Spans full table width

**Visual Polish**:
- [ ] Icon is large (fa-2x) and semi-transparent (opacity-30)
- [ ] Message is centered and readable
- [ ] No jarring or harsh colors
- [ ] Professional, empty state design

---

## Performance Checks

### Load Time
- [ ] Page loads quickly (<2 seconds)
- [ ] Table renders smoothly without flickering
- [ ] Modal open/close is instantaneous
- [ ] Sorting/filtering updates quickly

### Memory Usage
- [ ] No console errors or warnings
- [ ] No memory leaks when opening/closing modals repeatedly
- [ ] Browser DevTools shows no warnings

### Responsiveness
- [ ] Page is responsive on mobile (<768px)
- [ ] Buttons stack or resize appropriately
- [ ] Table scrolls horizontally if needed
- [ ] Modal displays properly on smaller screens

---

## Final Checks

- [ ] All buttons have appropriate icons
- [ ] All buttons have descriptive tooltips
- [ ] All buttons provide visual feedback (hover, loading, active)
- [ ] All functionality works as expected
- [ ] No console errors in DevTools
- [ ] Mobile responsiveness is maintained
- [ ] Color scheme is consistent
- [ ] Accessibility is maintained (semantic HTML, proper ARIA labels)

---

## Notes
**Last Tested**: [Date/Time]  
**Browser**: [Chrome/Firefox/Edge/Safari]  
**Screen Resolution**: [1920x1080 / 768px / etc]  
**Issues Found**: [List any issues here]  
**Status**: ✅ All tests passing / ⚠️ Needs fixes

