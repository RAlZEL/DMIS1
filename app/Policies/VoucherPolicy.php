<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\voucher;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoucherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
            if(auth('web')->check())
       {
        return ($user); 
       }
    }

    public function viewMail(User $user)
    {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_route', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\voucher  $voucher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, voucher $voucher)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
      
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_add', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\voucher  $voucher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, voucher $voucher)
    {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_edit', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\voucher  $voucher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, voucher $voucher)
    {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_delete', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\voucher  $voucher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, voucher $voucher)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\voucher  $voucher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, voucher $voucher)
    {
        //
    }


    public function createAllocation (User $user) {

        
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',26)->where('can_add', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  

        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }


    }

    public function UpdateAllocation (User $user) {
         $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',26)->where('can_edit', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  

        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
    }


    
    public function viewAllocations (User $user) {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',26)->where('can_view', true)->get()->first();
       if(!empty($Role))
       {
           return ($user); 

       }  

       $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

       if($Role)
       {
           return ($user); 

       }
   }

   public function addAttachment(User $user, voucher $voucher)

   {        
       $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 

               if ($voucher->is_forwarded == false && $voucher->is_accepted == false &&  $voucher->is_rejected == false && $voucher->is_active == true  && $voucher->is_created == true  && $voucher->is_created == true) 
               {
                   $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_process', true)->where('can_add', true)->get();

                   if(!empty($Roles))
                       {
                           foreach ($Roles as $Role)
                           {
                               if (  $Role->roleid == '28' && $Role->can_process == true)
                               {
                                   return ($user);
                               }
                           }
                       }

               }

               if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true && $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid)  
               {
                 
                   $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_process', true)->get();

                   if(!empty($Roles))
                       {
                           foreach ($Roles as $Role)
                           {
                               if (  $Role->roleid == 28 && $Role->can_process == true)
                               {
                                   return ($user);
                               }
                           }
                       }

               }
   }

   public function addRoute(User $user, voucher $voucher)

   {


       $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

       if($Role)
       {
           return ($user); 

       }


       $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 

       if ($voucher->is_forwarded == false && $voucher->is_accepted == false &&  $voucher->is_rejected == false && $voucher->is_active == true && $voucher->is_created == true && $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid)  
       {


           $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_route', true)->where('can_add', true)->get();

           if(!empty($Roles))
               {
                   foreach ($Roles as $Role)
                   {
                       if (  $Role->roleid == '28' && $Role->can_route == true)
                       {
                           return ($user);
                       }
                   }
               }

       }

       if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true && $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
       {
         
           $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_route', true)->get();

           if(!empty($Roles))
               {
                   foreach ($Roles as $Role)
                   {
                       if (  $Role->roleid == 28 && $Role->can_route == true)
                       {
                           return ($user);
                       }
                   }
               }

       }

       if ($voucher->is_forwarded == true && $voucher->is_accepted == false &&  $voucher->is_rejected == false && $voucher->is_active == true && $voucher->from_officeid == $employee->officeid && $voucher->from_divisionid == $employee->divisionid && $voucher->from_unitid == $employee->unitid) 
       {
         
           $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_route', true)->get();

           if(!empty($Roles))
               {
                   foreach ($Roles as $Role)
                   {
                       if (  $Role->roleid == 28 && $Role->can_route == true)
                       {
                           return ($user);
                       }
                   }
               }

       }

       if ($voucher->is_forwarded == false && $voucher->is_accepted == false &&  $voucher->is_rejected == true && $voucher->is_active == true && $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
       {
         
           $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_route', true)->get();

           if(!empty($Roles))
               {
                   foreach ($Roles as $Role)
                   {
                       if (  $Role->roleid == 28 && $Role->can_route == true)
                       {
                           return ($user);
                       }
                   }
               }

       }

   }

   public function AcceptIncoming(User $user, voucher $voucher) {
    $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
    if ($voucher->is_forwarded == true && $voucher->is_accepted == false &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
    {
      
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_accept', true)->get();

        if(!empty($Roles))
            {
                foreach ($Roles as $Role)
                {
                    if (  $Role->roleid == 28 && $Role->can_accept == true)
                    {
                        return ($user);
                    }
                }
            }
    }

}


    public function AddCharging(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',29)->where('can_add', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 29 && $Role->can_add == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }

    public function addORS(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',30)->where('can_add', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 30 && $Role->can_add == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }

    public function approveVoucher(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',32)->where('can_process', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 32 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }


    public function addADA(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',33)->where('can_process', true)->where('can_add', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 33 && $Role->can_process == true && $Role->can_add == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }

    public function destroyADA(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',33)->where('can_process', true)->where('can_delete', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 33 && $Role->can_process == true && $Role->can_delete == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }

    public function viewADAFM(User $user) {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 33 && $Role->can_process == true)
                        {
                            return ($user);
                        }

                        if (  $Role->roleid == 32 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }

    }


    
    public function viewFinancialReport(User $user) {
    
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();
    
        if(!empty($Roles))
            {
                foreach ($Roles as $Role)
                {
                    if (  $Role->roleid == 37 && $Role->can_view == true)
                    {
                        return ($user);
                    }
                }
            }

    }



    public function addAccountingEntry(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',31)->where('can_add', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 31 && $Role->can_add == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }

    public function destroyAccountingEntry(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',31)->where('can_delete', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 31 && $Role->can_delete == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }



    public function updateAccountTitle(User $user) {

           
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',31)->where('can_edit', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 31 && $Role->can_edit == true)
                        {
                            return ($user);
                        }
                    }
                }

    }

    public function addAccountingTitle(User $user) {

           
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',31)->where('can_add', true)->get();

        if(!empty($Roles))
            {
                foreach ($Roles as $Role)
                {
                    if (  $Role->roleid == 31 && $Role->can_add == true)
                    {
                        return ($user);
                    }
                }
            }

}
    


    public function deleteORS(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',30)->where('can_delete', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 30 && $Role->can_delete == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }

    public function destroyCharging(User $user, voucher $voucher) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($voucher->is_forwarded == false && $voucher->is_accepted == true &&  $voucher->is_rejected == false && $voucher->is_active == true & $voucher->officeid == $employee->officeid && $voucher->divisionid == $employee->divisionid && $voucher->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',29)->where('can_delete', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 29 && $Role->can_delete == true)
                        {
                            return ($user);
                        }
                    }
                }
        }


    }



}
